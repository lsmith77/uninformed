<?php

/**
 * ClauseBody
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class ClauseBody extends BaseClauseBody
{
    protected $latestAdoptedClause;

    public function setUp()
    {
        parent::setUp();
        $this->hasAccessor('root_clause_body_id', 'getRootClauseBodyId');
    }

    public function getRootClauseBodyId() {
        $root_clause_body_id = $this->_get('root_clause_body_id');
        return empty($root_clause_body_id) ? $this->_get('id') : $root_clause_body_id;
    }

    public function preSave($event) {
        $invoker = $event->getInvoker();

        $root_clause_body_id = $invoker->_get('root_clause_body_id');
        $parent_clause_body_id = $invoker->_get('parent_clause_body_id');
        if (!empty($parent_clause_body_id) && empty($root_clause_body_id)) {
            $invoker->set('root_clause_body_id', $invoker->ClauseBodyParent->root_clause_body_id);
        }
    }

    public function getLatestAdoptedClause() {
        if (isset($this->latestAdoptedClause)) {
            return $this->latestAdoptedClause;
        }
        $max_adoption_date = Doctrine_Query::create()
            ->select('MAX(adoption_date)')
            ->from('Document d')
            ->innerJoin('d.Clauses c')
            ->where('c.clause_body_id = ?', $this->_get('id'))
            ->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);

        $this->latestAdoptedClause = Doctrine_Query::create()
            ->from('Clause c')
            ->innerJoin('c.Document d')
            ->where('d.adoption_date = ?', $max_adoption_date)
            ->fetchOne();

        return $this->latestAdoptedClause;
    }

    public function __call($method, $params) {
        try {
            return parent::__call($method, $params);
        } catch (Exception $e) {}

        $clause = $this->getLatestAdoptedClause();
        if (!is_object($clause)) {
            trigger_error(sprintf('Call to undefined function: %s::%s().', get_class($this), $method), E_USER_ERROR);
        }

        return call_user_func_array(array($clause, $method), $params);
    }
}
