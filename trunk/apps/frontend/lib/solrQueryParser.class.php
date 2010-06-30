<?php
/**
 * File containing solr query parser class
 * Adapted from ezcSearchQueryBuilder and ezcSearchQueryToken
 * http://svn.ezcomponents.org/viewvc.cgi/trunk/Search/src/
 *
 * @license http://ez.no/licenses/new_bsd New BSD License
 */
class solrQueryParser
{
    protected $state;

    protected $preEscapeState;

    protected $stack;

    protected $stackLevel;

    protected $stackType;

    protected $prefix;

    protected $factory;

    public function __construct($factory)
    {
        $this->setFactory($factory);
    }

    public function setFactory($factory)
    {
        $this->factory = $factory;
    }

    public function parse($searchQuery, $stack = null)
    {
        $this->reset($stack);

        return $this->tokenize($searchQuery);
    }

    public function reset($stack = null)
    {
        $this->state = 'normal';
        $this->preEscapeState = 'normal';
        $this->stackLevel = 0;
        if (is_array($stack)) {
            $this->stack = $stack;
        } else {
            $this->stack = array();
            $factory = $this->factory;
            $this->stack[$this->stackLevel] = $factory();
        }
        $this->stackType = array();
        $this->stackType[$this->stackLevel] = 'default';
        $this->prefix = null;
    }

    protected function tokenize($searchQuery)
    {
        $map = array(
            ' '  => solrQueryParserToken::SPACE,
            '\t' => solrQueryParserToken::SPACE,
            '"'  => solrQueryParserToken::QUOTE,
            '+'  => solrQueryParserToken::PLUS,
            '-'  => solrQueryParserToken::MINUS,
            '('  => solrQueryParserToken::BRACE_OPEN,
            ')'  => solrQueryParserToken::BRACE_CLOSE,
            'and' => solrQueryParserToken::LOGICAL_AND,
            'or'  => solrQueryParserToken::LOGICAL_OR,
            ':'  => solrQueryParserToken::COLON,
        );
        $tokens = array();
        $tokenArray = preg_split('@(\s)|(["+():-])@', $searchQuery, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        foreach ($tokenArray as $token) {
            if (isset($map[strtolower( $token )])) {
                $tokens[] = new solrQueryParserToken($map[strtolower($token)], $token);
            } else {
                $tokens[] = new solrQueryParserToken(solrQueryParserToken::STRING, $token);
            }
        }
        return $tokens;
    }

    public function buildQueryTerms($tokens)
    {
        $string = $prefix = $field = '';
        $factory = $this->factory;
        foreach ($tokens as $token) {
            switch ($this->state) {
            case 'normal':
                switch ($token->type) {
                case solrQueryParserToken::STRING:
                    $string .= $token->token;
                    if (substr($string, -1, 1) === '\\') {
                        $this->preEscapeState = $this->state;
                        $this->state = 'in-escape';
                        break;
                    }
                    if ($prefix || $field) {
                        $term = $factory();
                        $term->addTerm($string);
                        $term->setPrefix($prefix);
                        $term->setField($field);
                    } else {
                        $term = $string;
                    }
                    $this->stack[$this->stackLevel]->addTerm($term);
                    $string = $prefix = $field = '';
                    break;
                case solrQueryParserToken::COLON:
                    if ($field !== '') {
                        throw new Exception('Unescaped colon may not be part of a fielded string');
                    }
                    $field = $this->stack[$this->stackLevel]->popTerm();
                    if ($field instanceOf solrQueryParserTerm) {
                        $terms = $field->getTerms();
                        if (empty($terms) || count($terms) > 1) {
                            throw new Exception('Field name must be a string');
                        }
                        $prefix = $field->getPrefix();
                        $field = reset($terms);
                    } else {
                        $prefix = $this->stack[$this->stackLevel]->getPrefix();
                    }
                    break;

                case solrQueryParserToken::SPACE:
                    if ($string !== '') {
                        if ($prefix || $field) {
                            $term = $factory();
                            $term->addTerm($string);
                            $term->setPrefix($prefix);
                            $term->setField($field);
                        } else {
                            $term = $string;
                        }
                        $this->stack[$this->stackLevel]->addTerm($term);
                        $string = $prefix = $field = '';
                    }
                    break;

                case solrQueryParserToken::ESCAPE:
                    $string = $token->token;
                    $this->preEscapeState = $this->state;
                    $this->state = 'in-escape';
                    break;
                case solrQueryParserToken::QUOTE:
                    $this->state = 'in-quotes';
                    $string = '';
                    break;
                case solrQueryParserToken::LOGICAL_OR:
                    if ($this->stackType[$this->stackLevel] === 'and') {
                        throw new Exception('You can not mix AND and OR without using "(" or ")".');
                    }
                    $this->stackType[$this->stackLevel] = 'or';
                    break;
                case solrQueryParserToken::LOGICAL_AND:
                    if ($this->stackType[$this->stackLevel] === 'or') {
                        throw new Exception('You can not mix OR and AND without using "(" and ")".');
                    }
                    $this->stackType[$this->stackLevel] = 'and';
                    break;
                case solrQueryParserToken::BRACE_OPEN:
                    // TODO: having to increase the stack level twice is a hack
                    $this->stackLevel++;
                    $this->stack[$this->stackLevel] = $factory();
                    $this->stack[$this->stackLevel]->setPrefix($prefix);
                    $this->stack[$this->stackLevel]->setField($field);
                    $this->stackLevel++;
                    $this->stack[$this->stackLevel] = $factory();
                    $prefix = $field = '';
                    $this->stackType[$this->stackLevel] = 'default';
                    break;
                case solrQueryParserToken::BRACE_CLOSE:
                    $op = ($this->stackType[$this->stackLevel] == 'and' || $this->stackType[$this->stackLevel ] == 'default')
                        ? 'AND' : 'OR';
                    $term = $this->stack[$this->stackLevel];
                    unset($this->stack[$this->stackLevel]);
                    $this->stackLevel--;
                    $term->setOp($op);
                    $term->setPrefix($this->stack[$this->stackLevel]->getPrefix());
                    $term->setField($this->stack[$this->stackLevel]->getField());
                    unset($this->stack[$this->stackLevel]);
                    $this->stackLevel--;
                    $this->stack[$this->stackLevel]->addTerm($term);
                    break;

                case solrQueryParserToken::PLUS:
                case solrQueryParserToken::MINUS:
                    if ($prefix !== '') {
                        throw new Exception('No prefix allowed after a prefix');
                    }
                    $prefix = $token->token;
                    break;
                }
                break;
            case 'in-escape':
                switch ($token->type) {
                case solrQueryParserToken::STRING:
                case solrQueryParserToken::COLON:
                case solrQueryParserToken::SPACE:
                case solrQueryParserToken::QUOTE:
                case solrQueryParserToken::LOGICAL_AND:
                case solrQueryParserToken::LOGICAL_OR:
                case solrQueryParserToken::PLUS:
                case solrQueryParserToken::MINUS:
                case solrQueryParserToken::BRACE_OPEN:
                case solrQueryParserToken::BRACE_CLOSE:
                    $string .= $token->token;
                case solrQueryParserToken::ESCAPE:
                    $this->state = $this->preEscapeState;
                    break;
                }
                break;
            case 'in-quotes':
                switch ($token->type) {
                case solrQueryParserToken::ESCAPE:
                    $string .= $token->token;
                    $this->preEscapeState = $this->state;
                    $this->state = 'in-escape';
                    break;
                case solrQueryParserToken::QUOTE:
                    $string = trim($string);
                    if (empty($string)) {
                        throw new Exception('Filter may not be empty');
                    }
                    if ($prefix || $field) {
                        $term = $factory();
                        $term->addTerm($string);
                        $term->setPrefix($prefix);
                        $term->setField($field);
                    } else {
                        $term = $string;
                    }
                    $this->stack[$this->stackLevel]->addTerm($term);
                    $string = $prefix = $field = '';
                    $this->state = 'normal';
                    break;

                case solrQueryParserToken::STRING:
                case solrQueryParserToken::COLON:
                case solrQueryParserToken::SPACE:
                case solrQueryParserToken::LOGICAL_AND:
                case solrQueryParserToken::LOGICAL_OR:
                case solrQueryParserToken::PLUS:
                case solrQueryParserToken::MINUS:
                case solrQueryParserToken::BRACE_OPEN:
                case solrQueryParserToken::BRACE_CLOSE:
                    $string .= $token->token;
                    break;
                }
                break;
            }
        }

        if ($string !== '') {
            if ($prefix || $field) {
                $term = $factory();
                $term->addTerm($string);
                $term->setPrefix($prefix);
                $term->setField($field);
            } else {
                $term = $string;
            }
            $this->stack[$this->stackLevel]->addTerm($term);
        }

        if ($this->state == 'in-quotes') {
            throw new Exception('Unterminated quotes in query string.');
        }
        if (empty($this->stack[0])) {
            return array();
        }
        $this->stack = $this->stack[0];

        return $this->stack;
    }
}

class solrQueryParserToken
{
    const STRING = 1;
    const SPACE  = 2;
    const QUOTE  = 3;
    const PLUS   = 4;
    const MINUS  = 5;
    const BRACE_OPEN  = 6;
    const BRACE_CLOSE = 7;
    const LOGICAL_AND = 8;
    const LOGICAL_OR  = 9;
    const COLON  = 10;
    const ESCAPE  = 11;

    public $type;

    public $token;

    public function __construct($type, $token)
    {
        $this->type = $type;
        $this->token = $token;
    }
}

class solrQueryParserTerm
{
    protected $terms = array();

    protected $op;

    protected $prefix = '';

    protected $field = '';

    public function __construct($op = '')
    {
        $this->op = $op;
    }

    public function addTerm($term)
    {
        if ($term instanceOf solrQueryParserTerm) {
            $terms = $term->getTerms();
            if (count($terms) > 1) {
                throw new Exception('Brackets not allowed');
            }
        }
        $this->terms[] = $term;
    }

    public function getTerms()
    {
        return $this->terms;
    }

    public function setTerms($terms)
    {
        $this->terms = array();
        foreach ($terms as $term) {
            $this->addTerm($term);
        }
    }

    public function setOp($op)
    {
        $this->op = $op;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    public function getField()
    {
        return $this->field;
    }

    public function setField($field)
    {
        $this->field = $field;
    }

    public function popTerm()
    {
        return array_pop($this->terms);
    }

    protected function processTerm($term) {
        if ($term instanceOf solrQueryParserTerm) {
            $field = $term->field === '' ? $term->prefix : $term->prefix.$term->field.':';
            $term = $field.(string)$term;
        } elseif (strpos($term, ' ') !== false) {
            $term = '"'.$term.'"';
        }
        return $term;
    }

    public function implodeTerms()
    {
        $terms = $this->terms;
        $op = $this->op;
        foreach ($terms as $key => $term) {
            $terms[$key] = $this->processTerm($term);
        }
        if (count($terms) == 1) {
            return reset($terms);
        }
        $op = rtrim(" $op ").' ';
        return '('.implode($op, $terms).')';
    }

    public function __toString() {
        return (string)$this->implodeTerms();
    }
}

class solrQueryParserTermBrackets extends solrQueryParserTerm {
    public function addTerm($term)
    {
        $this->terms[] = $term;
    }
}

class solrQueryParserTermCustom extends solrQueryParserTerm {
    protected $criteria;

    public function __construct($op = '', $criteria = null)
    {
        $this->op = $op;
        $this->criteria = $criteria;
    }

    protected function processTerm($term) {
        $prefix = $term->prefix;
        $field = $term->field;
        $term = (string)$term;
        $op = $this->op;
        $op = rtrim(" $op ").' ';
        if (!empty($field)) {
            switch ($field) {
            case 'code':
                $field = substr($term, -1, 1) === '*' ? 'document_code_prefix' : 'document_code';
                $term = $field === 'document_code_prefix' ? substr($term, 0, -1) : $term;
                break;
            case 'tag':
                $field = 'tag_ids';
                $q = Doctrine_Query::create()
                    ->select('t.id')
                    ->from('Tag t')
                    ->where('t.name = ?', array($term));
                $term = $q->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
                break;
            default:
                throw new Exception('Unsupported field: '.$field);
            }
            $this->criteria->addField($prefix.$field, $term, $op);
            return;
        }
        $term = parent::processTerm($term);
        return $prefix.$term;
    }

    public function implodeTerms()
    {
        $terms = $this->terms;
        $op = $this->op;
        $op = rtrim(" $op ").' ';
        $dismax = array();
        foreach ($terms as $key => $term) {
            if ($term instanceOf solrQueryParserTerm) {
                $term = $this->processTerm($term);
                if (!is_null($term)) {
                    $dismax[] = $term;
                }
            } else {
                $dismax[] = parent::processTerm($term);
            }
        }
        if (!empty($dismax)) {
            $dismax = implode(' ', $dismax);
            $subcritieria = new sfLuceneCriteria;
            $subcritieria->add('_query_:"{!dismax qf=\'content document_title\' pf=\'content document_title\' mm=0 v=$qq}"', $op, true);
            $this->criteria->add($subcritieria, 'AND');
            $this->criteria->addParam('qq', $dismax);

            $this->criteria->addParam('hl', 'true');
            $this->criteria->addParam('hl.fl', '*');
            $this->criteria->addParam('hl.fragsize', '0');
            $this->criteria->addParam('hl.simple.pre', '<strong>');
            $this->criteria->addParam('hl.simple.post', '</strong>');
        }
    }
}
