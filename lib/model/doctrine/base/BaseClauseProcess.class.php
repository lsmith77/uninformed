<?php

/**
 * BaseClauseProcess
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property Doctrine_Collection $Clauses
 * 
 * @method integer             getId()      Returns the current record's "id" value
 * @method string              getName()    Returns the current record's "name" value
 * @method Doctrine_Collection getClauses() Returns the current record's "Clauses" collection
 * @method ClauseProcess       setId()      Sets the current record's "id" value
 * @method ClauseProcess       setName()    Sets the current record's "name" value
 * @method ClauseProcess       setClauses() Sets the current record's "Clauses" collection
 * 
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7294 2010-03-02 17:59:20Z jwage $
 */
abstract class BaseClauseProcess extends MyBaseRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('clause_process');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
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
             'local' => 'id',
             'foreign' => 'clause_process_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $blameable0 = new Doctrine_Template_Blameable(array(
             'default' => NULL,
             'blameVar' => 'id',
             'listener' => 'BlameableCustomListener',
             'columns' => 
             array(
              'created' => 
              array(
              'name' => 'author_id',
              'length' => 4,
              'options' => 
              array(
               'notnull' => false,
              ),
              ),
              'updated' => 
              array(
              'disabled' => true,
              ),
             ),
             'relations' => 
             array(
              'created' => 
              array(
              'class' => 'sfGuardUser',
              'disabled' => false,
              'name' => 'Author',
              ),
             ),
             ));
        $versionable0 = new Doctrine_Template_Versionable(array(
             'listener' => 'Doctrine_AuditLog_Listener_Microtime',
             ));
        $blameable1 = new Doctrine_Template_Blameable(array(
             'default' => NULL,
             'blameVar' => 'id',
             'listener' => 'BlameableCustomListener',
             'columns' => 
             array(
              'created' => 
              array(
              'name' => 'author_id',
              'length' => 4,
              'options' => 
              array(
               'notnull' => false,
              ),
              ),
              'updated' => 
              array(
              'disabled' => true,
              ),
             ),
             'relations' => 
             array(
              'created' => 
              array(
              'class' => 'sfGuardUser',
              'disabled' => false,
              'name' => 'Author',
              ),
             ),
             ));
        $versionable0->addChild($blameable1);
        $this->actAs($timestampable0);
        $this->actAs($blameable0);
        $this->actAs($versionable0);
    }
}