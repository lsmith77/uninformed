<?php

/**
 * BaseOrganisation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property Organisation $Parent
 * @property Doctrine_Collection $Suborganisations
 * @property Doctrine_Collection $Organisations
 * @property Doctrine_Collection $Countries
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method string              getName()             Returns the current record's "name" value
 * @method integer             getParentId()         Returns the current record's "parent_id" value
 * @method Organisation        getParent()           Returns the current record's "Parent" value
 * @method Doctrine_Collection getSuborganisations() Returns the current record's "Suborganisations" collection
 * @method Doctrine_Collection getOrganisations()    Returns the current record's "Organisations" collection
 * @method Doctrine_Collection getCountries()        Returns the current record's "Countries" collection
 * @method Organisation        setId()               Sets the current record's "id" value
 * @method Organisation        setName()             Sets the current record's "name" value
 * @method Organisation        setParentId()         Sets the current record's "parent_id" value
 * @method Organisation        setParent()           Sets the current record's "Parent" value
 * @method Organisation        setSuborganisations() Sets the current record's "Suborganisations" collection
 * @method Organisation        setOrganisations()    Sets the current record's "Organisations" collection
 * @method Organisation        setCountries()        Sets the current record's "Countries" collection
 * 
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseOrganisation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('organisation');
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
        $this->hasColumn('parent_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
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
             'foreign' => 'id'));

        $this->hasMany('Organisation as Suborganisations', array(
             'local' => 'id',
             'foreign' => 'parent_id'));

        $this->hasMany('Document as Organisations', array(
             'local' => 'id',
             'foreign' => 'organisation_id'));

        $this->hasMany('CountryOrganisation as Countries', array(
             'local' => 'id',
             'foreign' => 'organisation_id'));

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
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             'fields' => 
             array(
              0 => 'name',
             ),
             'canUpdate' => true,
             ));
        $this->actAs($timestampable0);
        $this->actAs($blameable0);
        $this->actAs($versionable0);
        $this->actAs($sluggable0);
    }
}