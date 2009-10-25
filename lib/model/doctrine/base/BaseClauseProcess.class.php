<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseClauseProcess extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('clauseprocesses');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('label', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasMany('Clause as Clauses', array(
             'local' => 'id',
             'foreign' => 'clause_process'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}