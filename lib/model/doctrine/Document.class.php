<?php

/**
 * Document
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Document extends BaseDocument
{
    protected $nameChange = false;

    protected $overloadProperty = 'DocumentType';

    protected static $autoCompletable = array(
        'code' => true,
    );

    public function setUp()
    {
        parent::setUp();
        $this->hasAccessor('root_document_id', 'getRootDocumentId');
    }

    public function getRootDocumentId() {
        $root_document_id = $this->_get('root_document_id');
        return empty($root_document_id) ? $this->_get('id') : $root_document_id;
    }

    public function preSave($event) {
        $invoker = $event->getInvoker();
        $slug = $invoker->_get('name');
        $slug = Doctrine_Inflector::urlize($slug);
        $invoker->_set('slug', $slug);

        // update clause slugs if the name changed
        $modified = $invoker->getModified();
        if (array_key_exists('name', $modified)) {
            $this->nameChange = true;
        }

        $root_document_id = $invoker->_get('root_document_id');
        $parent_document_id = $invoker->_get('parent_document_id');
        if (!empty($parent_document_id) && empty($root_document_id)) {
            $root_document_id = $invoker->DocumentParent->root_document_id;
            $invoker->set('root_document_id', $root_document_id);
        }
    }

    public function postSave($event) {
        if (!$this->nameChange) {
            return;
        }

        $this->nameChange = false;

        $invoker = $event->getInvoker();
        $clauses = $invoker->getClauses();
        foreach ($clauses as $clause) {
            $clause->save();
        }
    }

    public function getDocumentsByRoot() {
        $root_document_id = $this->root_document_id;

        $query = Doctrine_Query::create()
            ->from('Document d')
            ->where('d.id = ? OR d.root_document_id = ?', array($root_document_id, $root_document_id));

        return $query->execute();
    }

    public function getClauses() {
        $query = Doctrine_Query::create()
            ->from('Clause c')
            ->innerJoin('c.ClauseBody cb')
            ->where('c.document_id = ?', $this->_get('id'));

        $clauseOrdering = $this->_get('clause_ordering');
        if ($clauseOrdering) {
            $query->orderBy("FIELD(c.id,$clauseOrdering)");
        }

        return $query->execute();
    }

    public function getMainOrgan() {
        // TODO: check if ok like that
        $organ = $this->Organisation;
        $parent = $organ->OrganisationParent;
        $mainOrgan = $parent ? $parent : $organ;
        return $mainOrgan;
    }

    public function getSlug() {
        return $this->_get('id').'-'.$this->_get('slug');
    }

    public function __toString() {
        return (string)$this->_get('code');
    }
}
