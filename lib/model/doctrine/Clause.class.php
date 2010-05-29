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

    public $adoptionDateChange = false;

    public function __toString() {
        $identifier = (string)$this->_get('Document');
        $identifier.= $this->getFullClauseNumber();
        if ($this->_get('ClauseBody')->_get('ClauseInformationType')) {
            $identifier.= ' '.$this->_get('ClauseBody')->_get('ClauseInformationType')->_get('name');
        }
        return trim($identifier);
    }

    public function preSave($event) {
        $invoker = $event->getInvoker();
        if (!$this->exists()) {
            $slug = (string)$invoker;
            $slug = substr(Doctrine_Inflector::urlize($slug), 0, 30);
            $invoker->_set('slug', $slug);
            $this->adoptionDateChange = true;
        } else {
            $modified = $invoker->getModified();
            if (array_key_exists('document_id', $modified)) {
                $this->forceIsLatestClauseUpdate();
            }
        }
    }

    public function postSave($event) {
        if (!$this->adoptionDateChange) {
            return;
        }

        $this->adoptionDateChange = false;

        $invoker = $event->getInvoker();
        if ($invoker->ClauseBody) {
            $root_clause_body_id = $invoker->ClauseBody->_get('root_clause_body_id');
            if (!empty($root_clause_body_id)) {
                return;
            }

            $clause = $invoker->getLatestAdoptedClause();
            if (empty($clause)) {
                return;
            }

            $root_clause_body_id = $invoker->_get('clause_body_id');
            $q = Doctrine_Query::create()
                ->select('c.*')
                ->from('Clause c')
                ->innerJoin('c.ClauseBody cb')
                ->where('cb.root_clause_body_id = ? OR cb.id = ?', array($root_clause_body_id, $root_clause_body_id));
            $clauses = $q->execute(array(), Doctrine_Core::HYDRATE_ON_DEMAND);

            $latest_clause_id = $clause->getId();
            foreach ($clauses as $clause) {
                $is_latest_clause = $clause->getId() == $latest_clause_id;
                if ($clause->getIsLatestClause() != $is_latest_clause) {
                    $clause->setIsLatestClause($is_latest_clause);
                    $clause->save();
                }
            }
        }
    }

    public function forceIsLatestClauseUpdate() {
        if (empty($this->ClauseBody)) {
            return;
        }

        $root_clause_body_id = $this->ClauseBody->_get('root_clause_body_id');
        if (is_null($root_clause_body_id)) {
            $q = Doctrine_Query::create()
                ->select('cb.id')
                ->from('ClauseBody cb')
                ->where('cb.root_clause_body_id = ?', array($this->_get('clause_body_id')))
                ->limit(1);
            $clause = $q->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
            if (empty($clause)) {
                if (!$this->getIsLatestClause()) {
                    $this->setIsLatestClause(true);
                    $this->save();
                }
                return;
            }
            $clause = $this;
        } else {
            $q = Doctrine_Query::create()
                ->select('c.*, cb.id, cb.root_clause_body_id')
                ->from('Clause c')
                ->innerJoin('c.ClauseBody cb')
                ->where('cb.id = ?', array($root_clause_body_id));
            $clause = $q->fetchOne();
            if (empty($clause)) {
                return;
            }
        }

        $clause->adoptionDateChange = true;
        $clause->save();
    }

    public function getLatestAdoptedClause() {
        $root_clause_body_id = $this->ClauseBody->root_clause_body_id;
        $clause_body_ids = Doctrine_Query::create()
            ->select('cb.id')
            ->from('ClauseBody cb INDEXBY cb.id')
            ->where('cb.root_clause_body_id = ? OR cb.id = ?', array($root_clause_body_id, $root_clause_body_id))
            ->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
        if (empty($clause_body_ids)) {
            return null;
        }

        if (count($clause_body_ids) === 1) {
            return $this;
        }

        $clause_body_ids = array_keys($clause_body_ids);

        return Doctrine_Query::create()
            ->select('c.*')
            ->from('Clause c')
            ->innerJoin('c.Document d')
            ->whereIn('c.clause_body_id', $clause_body_ids)
            ->orderBy('d.adoption_date DESC')
            ->fetchOne();
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

    public function getOperativePhraseId() {
        return $this->_get('ClauseBody')->_get('operative_phrase_id');
    }

    public function getInformationTypeId() {
        return $this->_get('ClauseBody')->_get('information_type_id');
    }

    public function getContent() {
        return $this->_get('ClauseBody')->getContent();
    }

    public function getTagIds() {
        return $this->_get('ClauseBody')->getTagIds();
    }

    public function getAddresseeIds() {
        $ids = Doctrine_Query::create()
            ->select('addressee_id')
            ->from('ClauseAddressee')
            ->where('clause_body_id = ?', $this->_get('clause_body_id'))
            ->execute(array(), Doctrine_Core::HYDRATE_SCALAR);
        foreach ($ids as $key => $id) {
            $ids[$key] = reset($id);
        }
        return $ids;
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
