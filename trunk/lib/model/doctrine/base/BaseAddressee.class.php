<?php

/**
 * BaseAddressee
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property Doctrine_Collection $Clauses
 * @property Doctrine_Collection $ClauseAddressee
 * 
 * @method integer             getId()              Returns the current record's "id" value
 * @method string              getName()            Returns the current record's "name" value
 * @method Doctrine_Collection getClauses()         Returns the current record's "Clauses" collection
 * @method Doctrine_Collection getClauseAddressee() Returns the current record's "ClauseAddressee" collection
 * @method Addressee           setId()              Sets the current record's "id" value
 * @method Addressee           setName()            Sets the current record's "name" value
 * @method Addressee           setClauses()         Sets the current record's "Clauses" collection
 * @method Addressee           setClauseAddressee() Sets the current record's "ClauseAddressee" collection
 * 
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseAddressee extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('addressee');
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

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('ClauseBody as Clauses', array(
             'refClass' => 'ClauseAddressee',
             'local' => 'id',
             'foreign' => 'id'));

        $this->hasMany('ClauseBody as ClauseAddressee', array(
             'local' => 'id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $blameable0 = new Doctrine_Template_Blameable(array(
             'default' => NULL,
             'blameVar' => 'user_id',
             'listener' => 'BlameableCustomListener',
             'columns' => 
             array(
              'updated' => 
              array(
              'disabled' => true,
              ),
             ),
             'relations' => 
             array(
              'class' => 'sfGuardUser',
              'disabled' => false,
             ),
             ));
        $versionable0 = new Doctrine_Template_Versionable(array(
             ));
        $blameable1 = new Doctrine_Template_Blameable(array(
             'default' => NULL,
             'blameVar' => 'user_id',
             'listener' => 'BlameableCustomListener',
             'columns' => 
             array(
              'updated' => 
              array(
              'disabled' => true,
              ),
             ),
             'relations' => 
             array(
              'class' => 'sfGuardUser',
              'disabled' => false,
             ),
             ));
        $versionable0->addChild($blameable1);
        $this->actAs($timestampable0);
        $this->actAs($blameable0);
        $this->actAs($versionable0);
    }
}