<?php

/**
 * BaseClauseAddressee
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $clause_body_id
 * @property integer $addressee_id
 * 
 * @method integer         getId()             Returns the current record's "id" value
 * @method integer         getClauseBodyId()   Returns the current record's "clause_body_id" value
 * @method integer         getAddresseeId()    Returns the current record's "addressee_id" value
 * @method ClauseAddressee setId()             Sets the current record's "id" value
 * @method ClauseAddressee setClauseBodyId()   Sets the current record's "clause_body_id" value
 * @method ClauseAddressee setAddresseeId()    Sets the current record's "addressee_id" value
 * 
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseClauseAddressee extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('clause_addressee');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('clause_body_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('addressee_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));


        $this->index('mapping', array(
             'fields' => 
             array(
              0 => 'clause_body_id',
              1 => 'addressee_id',
             ),
             'type' => 'unique',
             ));
        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $blameable0 = new Doctrine_Template_Blameable(array(
             'default' => NULL,
             'blameVar' => 'user_id',
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
             ));
        $blameable1 = new Doctrine_Template_Blameable(array(
             'default' => NULL,
             'blameVar' => 'user_id',
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