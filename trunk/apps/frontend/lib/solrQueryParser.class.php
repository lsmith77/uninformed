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
    private $state;

    private $stack;

    private $stackLevel;

    private $stackType;

    private $prefix;

    public function parse($searchQuery)
    {
        $this->reset();

        return $this->tokenize($searchQuery);
    }

    public function reset()
    {
        $this->state = 'normal';
        $this->stackLevel = 0;
        $this->stack = array();
        $this->stack[$this->stackLevel] = array();
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
            ':'   => solrQueryParserToken::COLON,
            '\\'   => solrQueryParserToken::ESCAPE,
        );
        $tokens = array();
        $tokenArray = preg_split('@(\s)|(["+():-])@', $searchQuery, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        foreach ($tokenArray as $token) {
            if (isset($map[strtolower( $token )])) {
                $tokens[] = new solrQueryParserToken($map[strtolower( $token )], $token);
            } else {
                $tokens[] = new solrQueryParserToken(solrQueryParserToken::STRING, $token);
            }
        }
        return $tokens;
    }

    public function buildQueryTerms($q)
    {
        $tokens = $this->parse($q);

        foreach ($tokens as $token) {
            switch ($this->state) {
            case 'normal':
                switch ($token->type) {
                case solrQueryParserToken::SPACE:
                    /* ignore */
                    break;

                case solrQueryParserToken::STRING:
                    $this->stack[$this->stackLevel][] = $token->token;
                    break;

                case solrQueryParserToken::QUOTE:
                    $this->state = 'in-quotes';
                    $string = '';
                    break;

                case solrQueryParserToken::LOGICAL_OR:
                    if ( $this->stackType[$this->stackLevel] === 'and' ) {
                        throw new Exception( 'You can not mix AND and OR without using "(" and ")".' );
                    } else {
                        $this->stackType[$this->stackLevel] = 'or';
                    }
                    break;

                case solrQueryParserToken::LOGICAL_AND:
                    if ( $this->stackType[$this->stackLevel] === 'or' ) {
                        throw new Exception( 'You can not mix OR and AND without using "(" and ")".' );
                    } else {
                        $this->stackType[$this->stackLevel] = 'and';
                    }
                    break;

                case solrQueryParserToken::BRACE_OPEN:
                    $this->stackLevel++;
                    $this->stackType[$this->stackLevel] = 'default';
                    break;

                case solrQueryParserToken::BRACE_CLOSE:
                    $this->stackLevel--;
                    if ( $this->stackType[$this->stackLevel + 1] == 'and' || $this->stackType[$this->stackLevel + 1] == 'default' ) {
                        $this->stack[$this->stackLevel + 1]['op'] = 'and';
                        $this->stack[$this->stackLevel][] = $this->stack[$this->stackLevel + 1];
                    } else {
                        $this->stack[$this->stackLevel + 1]['op'] = 'or';
                        $this->stack[$this->stackLevel][] = $this->stack[$this->stackLevel + 1];
                    }
                    break;

                case solrQueryParserToken::PLUS:
                case solrQueryParserToken::MINUS:
                    $this->prefix = $token->type;
                    break;
                }
                break;
            case 'in-escape':
                switch ($token->type) {
                case solrQueryParserToken::ESCAPE:
                    $string .= $token->token;
                    $this->state = 'normal';
                    break;
                case solrQueryParserToken::QUOTE:
                    $string .= $token->token;
                    $this->state = 'in-quotes';
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
            case 'in-quotes':
                switch ($token->type) {
                case solrQueryParserToken::ESCAPE:
                    $string .= $token->token;
                    $this->state = 'in-escape';
                    break;
                case solrQueryParserToken::QUOTE:
                    $this->stack[$this->stackLevel][] = $string;
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
        if ($this->state == 'in-quotes') {
            throw new Exception( 'Unterminated quotes in query string.' );
        }

        return $this->stack[0];
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

    public function __construct( $type, $token )
    {
        $this->type = $type;
        $this->token = $token;
    }
}
