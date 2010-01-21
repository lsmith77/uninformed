<?php

/**
 * BaseClauseReservation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $clause_body_id
 * @property integer $country_id
 * @property clob $reservation
 * @property ClauseBody $Clause
 * @property Country $Country
 * 
 * @method integer           getId()             Returns the current record's "id" value
 * @method integer           getClauseBodyId()   Returns the current record's "clause_body_id" value
 * @method integer           getCountryId()      Returns the current record's "country_id" value
 * @method clob              getReservation()    Returns the current record's "reservation" value
 * @method ClauseBody        getClause()         Returns the current record's "Clause" value
 * @method Country           getCountry()        Returns the current record's "Country" value
 * @method ClauseReservation setId()             Sets the current record's "id" value
 * @method ClauseReservation setClauseBodyId()   Sets the current record's "clause_body_id" value
 * @method ClauseReservation setCountryId()      Sets the current record's "country_id" value
 * @method ClauseReservation setReservation()    Sets the current record's "reservation" value
 * @method ClauseReservation setClause()         Sets the current record's "Clause" value
 * @method ClauseReservation setCountry()        Sets the current record's "Country" value
 * 
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseClauseReservation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('clause_reservation');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('clause_body_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('country_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('reservation', 'clob', null, array(
             'type' => 'clob',
             ));


        $this->index('mapping', array(
             'fields' => 
             array(
              0 => 'clause_body_id',
              1 => 'country_id',
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
        $this->hasOne('ClauseBody as Clause', array(
             'local' => 'clause_body_id',
             'foreign' => 'id'));

        $this->hasOne('Country', array(
             'local' => 'country_id',
             'foreign' => 'id'));

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