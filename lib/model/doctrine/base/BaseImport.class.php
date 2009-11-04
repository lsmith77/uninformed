<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseImport extends BaseRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('imports');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasMany('ExcelFile', array(
             'local' => 'id',
             'foreign' => 'import_id'));

        $this->hasMany('Document', array(
             'local' => 'id',
             'foreign' => 'import_id'));

        $this->hasMany('Clause', array(
             'local' => 'id',
             'foreign' => 'import_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}