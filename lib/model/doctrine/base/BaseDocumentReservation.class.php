<?php

/**
 * BaseDocumentReservation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $document_id
 * @property integer $country_id
 * @property clob $reservation
 * @property Document $Document
 * @property Country $Country
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method integer             getDocumentId()  Returns the current record's "document_id" value
 * @method integer             getCountryId()   Returns the current record's "country_id" value
 * @method clob                getReservation() Returns the current record's "reservation" value
 * @method Document            getDocument()    Returns the current record's "Document" value
 * @method Country             getCountry()     Returns the current record's "Country" value
 * @method DocumentReservation setId()          Sets the current record's "id" value
 * @method DocumentReservation setDocumentId()  Sets the current record's "document_id" value
 * @method DocumentReservation setCountryId()   Sets the current record's "country_id" value
 * @method DocumentReservation setReservation() Sets the current record's "reservation" value
 * @method DocumentReservation setDocument()    Sets the current record's "Document" value
 * @method DocumentReservation setCountry()     Sets the current record's "Country" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDocumentReservation extends MyBaseRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('document_reservation');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('document_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('country_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('reservation', 'clob', null, array(
             'type' => 'clob',
             ));


        $this->index('mapping', array(
             'fields' => 
             array(
              0 => 'document_id',
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
        $this->hasOne('Document', array(
             'local' => 'document_id',
             'foreign' => 'id'));

        $this->hasOne('Country', array(
             'local' => 'country_id',
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