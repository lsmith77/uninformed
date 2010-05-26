<?php

/**
 * Clause
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Clause extends BaseClause
{
    protected static $autoCompletable = array(
        'slug' => true,
    );

    public function __toString() {
        $identifier = (string)$this->_get('Document');
        $identifier.= $this->getFullClauseNumber();
        if ($this->_get('ClauseBody')->_get('ClauseInformationType')) {
            $identifier.= ' '.$this->_get('ClauseBody')->_get('ClauseInformationType')->_get('name');
        }
        return trim($identifier);
    }

    public function preSave($event) {
        if (!$this->exists()) {
            $invoker = $event->getInvoker();

            $slug = (string)$invoker;
            $slug = substr(Doctrine_Inflector::urlize($slug), 0, 30);
            $invoker->_set('slug', $slug);
        }
    }

    public function postSave($event) {
        $invoker = $event->getInvoker();
        if ($invoker->ClauseBody) {
            $root_clause_body_id = $invoker->ClauseBody->root_clause_body_id;

            $clause = $invoker->ClauseBody->setLatestAdoptedClause();
            $clause = empty($clause) ? $invoker : $clause;
            $latest_clause_body_id = $clause->_get('clause_body_id');

            $q = Doctrine_Query::create()
                ->update('ClauseBody')
                ->set('is_latest_clause_body', "CASE WHEN id = $latest_clause_body_id THEN 1 ELSE 0 END")
                ->where('root_clause_body_id = ? OR id = ?', array($root_clause_body_id, $root_clause_body_id));
            $q->execute();
        }
    }

    public function getTitle() {
        return $this->getTitle().' ('.(string)$this.')';
    }

    public function getDocumentTitle() {
        return $this->_get('Document')->_get('title');
    }

    public function getFullClauseNumber() {
        $number = ' #'.$this->_get('clause_number');
        if ($this->_get('clause_number_information')) {
            $number.= ' '.$this->_get('clause_number_information');
        }
        if ($this->_get('clause_number_subparagraph')) {
            $number.= ' '.$this->_get('clause_number_subparagraph');
        }
        return $number;
    }

    public function getDocumenttypeId() {
        return $this->_get('Document')->_get('documenttype_id');
    }

    public function getOrganisationId() {
        return $this->_get('Document')->_get('organisation_id');
    }

    public function getLegalValue() {
        return $this->_get('Document')->getLegalValue();
    }

    public function getAdoptionYear() {
        return $this->_get('Document')->getAdoptionYear();
    }

    public function getAdoptionDate() {
        $adoption_date = $this->_get('Document')->_get('adoption_date');
        return date('Y-m-d\TH:i:s\Z', strtotime($adoption_date));
    }

    public function getSlug() {
        return $this->_get('id').'-'.$this->_get('slug');
    }

    public function getClausesByRoot() {
        $root_clause_body_id = $this->ClauseBody->root_clause_body_id;
        try {
            $query = Doctrine_Query::create()
                ->from('Clause c INDEXBY c.document_id')
                ->innerJoin('c.ClauseBody cb')
                ->innerJoin('c.Document d')
                ->where('cb.id = ? OR cb.root_clause_body_id = ?', array($root_clause_body_id, $root_clause_body_id))
                ->orderBy('d.adoption_date');
        } catch (Exception $e) {
            // TODO: we cannot handle splits
            return array();
        }

        return $query->execute();
    }
}
