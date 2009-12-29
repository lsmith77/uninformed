<?php

/**
 * BaseLegalValue
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property enum $decision_type
 * @property Doctrine_Collection $DocumentType
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method string              getName()          Returns the current record's "name" value
 * @method enum                getDecisionType()  Returns the current record's "decision_type" value
 * @method Doctrine_Collection getDocumentType()  Returns the current record's "DocumentType" collection
 * @method LegalValue          setId()            Sets the current record's "id" value
 * @method LegalValue          setName()          Sets the current record's "name" value
 * @method LegalValue          setDecisionType()  Sets the current record's "decision_type" value
 * @method LegalValue          setDocumentType()  Sets the current record's "DocumentType" collection
 * 
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseLegalValue extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('legal_value');
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
        $this->hasColumn('decision_type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'vote',
              1 => 'ratification',
             ),
             'notnull' => false,
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('DocumentType', array(
             'local' => 'id',
             'foreign' => 'legalvalue_id'));

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