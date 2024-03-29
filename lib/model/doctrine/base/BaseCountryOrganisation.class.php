<?php

/**
 * BaseCountryOrganisation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $country_id
 * @property integer $organisation_id
 * @property Country $Country
 * @property Organisation $Organisation
 * 
 * @method integer             getId()              Returns the current record's "id" value
 * @method integer             getCountryId()       Returns the current record's "country_id" value
 * @method integer             getOrganisationId()  Returns the current record's "organisation_id" value
 * @method Country             getCountry()         Returns the current record's "Country" value
 * @method Organisation        getOrganisation()    Returns the current record's "Organisation" value
 * @method CountryOrganisation setId()              Sets the current record's "id" value
 * @method CountryOrganisation setCountryId()       Sets the current record's "country_id" value
 * @method CountryOrganisation setOrganisationId()  Sets the current record's "organisation_id" value
 * @method CountryOrganisation setCountry()         Sets the current record's "Country" value
 * @method CountryOrganisation setOrganisation()    Sets the current record's "Organisation" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCountryOrganisation extends MyBaseRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('country_organisation');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('country_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('organisation_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Country', array(
             'local' => 'country_id',
             'foreign' => 'id'));

        $this->hasOne('Organisation', array(
             'local' => 'organisation_id',
             'foreign' => 'id'));

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
        $temporal0 = new Doctrine_Template_Temporal(array(
             'unique_fields' => 
             array(
              0 => 'country_id',
              1 => 'organisation_id',
             ),
             ));
        $this->actAs($timestampable0);
        $this->actAs($blameable0);
        $this->actAs($temporal0);
    }
}