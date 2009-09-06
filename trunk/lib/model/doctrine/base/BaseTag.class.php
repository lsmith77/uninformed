<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseTag extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tags');
        $this->hasColumn('tag_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('tag_type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => '',
              1 => 'legal_measure',
             ),
             'notnull' => true,
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        $this->hasMany('Clause as Clauses', array(
             'refClass' => 'ClauseTag',
             'local' => 'tag_id',
             'foreign' => 'clause_id'));

        $this->hasMany('Document as Documents', array(
             'refClass' => 'DocumentTag',
             'local' => 'tag_id',
             'foreign' => 'document_id'));

        $this->hasMany('TagHierarchie as TagHierarchies', array(
             'refClass' => 'TagHierarchieTag',
             'local' => 'tag_id',
             'foreign' => 'taghierarchie_id'));

        $this->hasMany('TagImplication', array(
             'local' => 'tag_id',
             'foreign' => 'tag_right_hand'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}