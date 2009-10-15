<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseDocument extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('documents');
        $this->hasColumn('document_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('publication_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('adoption_date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('code', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('min_ratification_count', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('preamble', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('parent_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('organisation_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('documenttype_id', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Document as Parent', array(
             'local' => 'parent_id',
             'foreign' => 'document_id'));

        $this->hasOne('Organisation', array(
             'local' => 'organisation_id',
             'foreign' => 'organisation_id'));

        $this->hasOne('DocumentType', array(
             'local' => 'documenttype_id',
             'foreign' => 'documenttype_id'));

        $this->hasMany('Tag as Tags', array(
             'refClass' => 'DocumentTag',
             'local' => 'document_id',
             'foreign' => 'tag_id'));

        $this->hasMany('Document as Subdocuments', array(
             'local' => 'document_id',
             'foreign' => 'parent_id'));

        $this->hasMany('DocumentRelation', array(
             'local' => 'document_id',
             'foreign' => 'document_right_hand'));

        $this->hasMany('Clause as Clauses', array(
             'local' => 'document_id',
             'foreign' => 'document_id'));

        $this->hasMany('Vote as Votes', array(
             'local' => 'document_id',
             'foreign' => 'document_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}