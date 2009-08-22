<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseTags extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tags');
        $this->hasColumn('tag_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('name', 'string', 45, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '45',
             ));
        $this->hasColumn('tag_type', 'enum', 13, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'legal_measure',
             ),
             'length' => '13',
             ));
    }

    public function setUp()
    {
        $this->hasMany('Clause2tag', array(
             'local' => 'tag_id',
             'foreign' => 'tag_id'));

        $this->hasMany('Document2tag', array(
             'local' => 'tag_id',
             'foreign' => 'tag_id'));

        $this->hasMany('Taghierachie2tag', array(
             'local' => 'tag_id',
             'foreign' => 'tag_id'));

        $this->hasMany('Tagimplications', array(
             'local' => 'tag_id',
             'foreign' => 'implied_tag_id'));

        $this->hasMany('Tagimplications as Tagimplications_2', array(
             'local' => 'tag_id',
             'foreign' => 'tag_id'));
    }
}