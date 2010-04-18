<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseExcelFile extends BaseRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('excelfiles');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('tag_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('author', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('file', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('import_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('is_imported', 'boolean', null, array(
             'type' => 'boolean',
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Tag', array(
             'local' => 'tag_id',
             'foreign' => 'tag_id'));

        $this->hasOne('Import', array(
             'local' => 'import_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}