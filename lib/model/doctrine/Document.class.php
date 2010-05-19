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
    protected $titleChange = false;

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
        $slug = $invoker->_get('title');
        $slug = substr(Doctrine_Inflector::urlize($slug), 0, 30);
        $invoker->_set('slug', $slug);

        // update clause slugs if the name changed
        $modified = $invoker->getModified();
        if (array_key_exists('title', $modified)) {
            $this->titleChange = true;
        }

        $root_document_id = $invoker->_get('root_document_id');
        $parent_document_id = $invoker->_get('parent_document_id');
        if (!empty($parent_document_id) && empty($root_document_id)) {
            $root_document_id = $invoker->DocumentParent->root_document_id;
            $invoker->set('root_document_id', $root_document_id);
        }
    }

    public function postSave($event) {
        if (!$this->titleChange) {
            return;
        }

        $this->titlechange = false;

        $invoker = $event->getInvoker();
        $clauses = $invoker->getClauses();
        foreach ($clauses as $clause) {
            $slug = (string)$clause;
            $slug = substr(Doctrine_Inflector::urlize($slug), 0, 30);
            $clause->_set('slug', $slug);
            $clause->save();
        }
    }

    public function getDocumentsByRoot() {
        $root_document_id = $this->root_document_id;

        $query = Doctrine_Query::create()
            ->from('Document d')
            ->where('d.id = ? OR d.root_document_id = ?', array($root_document_id, $root_document_id))
            ->orderBy('d.adoption_date');

        return $query->execute();
    }

    public function getClauseList() {
        $query = Doctrine_Query::create()
            ->from('Clause c')
            ->innerJoin('c.ClauseBody cb')
            ->where('c.document_id = ?', $this->_get('id'))
            ->orderBy("c.clause_number, c.clause_number_information, c.clause_number_subparagraph");

        return $query->execute();
    }

    public function getStructuredOrganisation() {
        $s = array('main' => '', 'current' => '', 'sub' => '', );

        $q = Doctrine_Query::create()
            ->select('so.name, so.parent_id, mo.name, mo.parent_id')
            ->from('Organisation so')
            ->innerJoin('so.OrganisationParent mo')
            ->where('so.id = ?', array($this->getOrganisationId()));
        $suborgan = $q->fetchArray();
        if (!empty($suborgan)) {
            $suborgan = reset($suborgan);
            if ($suborgan['OrganisationParent']['parent_id']) {
                $q = Doctrine_Query::create()
                    ->select('o.name')
                    ->from('Organisation o')
                    ->where('o.id = ?', array($suborgan['OrganisationParent']['parent_id']));
                $s['main'] =  $q->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);;
                $s['current'] = $suborgan['OrganisationParent']['name'];
                $s['sub'] = $suborgan['name'];
            } else {
                $s['main'] =  $suborgan['OrganisationParent']['name'];
                $s['current'] = $suborgan['name'];
            }
        }
        return $s;
    }

    public function getLegalValue() {
        return $this->_get('DocumentType')->_get('legal_value');
    }

    public function getSlug() {
        return $this->_get('id').'-'.$this->_get('slug');
    }

    public function __toString() {
        if (strlen($this->_get('code')) > 3) {
            return (string)$this->_get('code');
        }
        if (strlen($this->_get('title')) < 20) {
            return (string)$this->_get('title');
        }
        return (string)substr($this->_get('title'), 0, 20).'..';
    }
}
