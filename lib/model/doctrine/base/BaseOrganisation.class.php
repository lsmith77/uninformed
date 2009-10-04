<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseOrganisation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('organisations');
        $this->hasColumn('organisation_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('parent_id', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Organisation as Parent', array(
             'local' => 'parent_id',
             'foreign' => 'organisation_id'));

        $this->hasMany('Organisation as Suborganisations', array(
             'local' => 'organisation_id',
             'foreign' => 'parent_id'));

        $this->hasMany('Document as Organisations', array(
             'local' => 'organisation_id',
             'foreign' => 'organisation_id'));

        $this->hasMany('MemberstateOrganisation as Memberstates', array(
             'local' => 'organisation_id',
             'foreign' => 'organisation_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}