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
            ' ' => solrQueryParserToken::SPACE,
            '\t' => solrQueryParserToken::SPACE,
            '"' => solrQueryParserToken::QUOTE,
            '\\' => solrQueryParserToken::ESCAPE,
        );
        $tokens = array();
        $tokenArray = preg_split('@(\s)|(["])@', $searchQuery, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        foreach ($tokenArray as $token) {
            if (isset($map[strtolower( $token )])) {
                $tokens[] = new solrQueryParserToken($map[strtolower($token)], $token);
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
                    $pieces = explode(':', $token->token);
                    $count = count($pieces);
                    if ($count > 2) {
                        throw new Exception('String may only contain a single colon');
                    } elseif ($count == 1) {
                        $this->stack[$this->stackLevel][] = $token->token;
                    } elseif (empty($pieces[1])) {
                        throw new Exception('Filter may not be empty');
                    } else {
                        $this->stack[$this->stackLevel][] = array('field' => $pieces[0], 'criteria' => $pieces[1]);
                    }
                    break;

                case solrQueryParserToken::QUOTE:
                    $this->state = 'in-quotes';
                    $string = '';
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
                case solrQueryParserToken::SPACE:
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
                    $string = trim($string);
                    if (empty($string)) {
                        throw new Exception('Filter may not be empty');
                    }
                    $this->stack[$this->stackLevel][] = $string;
                    $this->state = 'normal';
                    break;

                case solrQueryParserToken::STRING:
                case solrQueryParserToken::SPACE:
                    $string .= $token->token;
                    break;
                }
                break;
            }

        }
        if ($this->state == 'in-quotes') {
            throw new Exception('Unterminated quotes in query string.');
        }

        return $this->stack[0];
    }
}

class solrQueryParserToken
{
    const STRING = 1;
    const SPACE  = 2;
    const QUOTE  = 3;
    const ESCAPE  = 4;

    public $type;

    public $token;

    public function __construct($type, $token)
    {
        $this->type = $type;
        $this->token = $token;
    }
}
