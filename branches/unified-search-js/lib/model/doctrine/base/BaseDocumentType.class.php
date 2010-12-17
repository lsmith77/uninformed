<?php

/**
 * BaseDocumentType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property integer $rank_priority
 * @property string $legal_value
 * @property clob $description
 * @property Doctrine_Collection $Documents
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method string              getName()          Returns the current record's "name" value
 * @method integer             getRankPriority()  Returns the current record's "rank_priority" value
 * @method string              getLegalValue()    Returns the current record's "legal_value" value
 * @method clob                getDescription()   Returns the current record's "description" value
 * @method Doctrine_Collection getDocuments()     Returns the current record's "Documents" collection
 * @method DocumentType        setId()            Sets the current record's "id" value
 * @method DocumentType        setName()          Sets the current record's "name" value
 * @method DocumentType        setRankPriority()  Sets the current record's "rank_priority" value
 * @method DocumentType        setLegalValue()    Sets the current record's "legal_value" value
 * @method DocumentType        setDescription()   Sets the current record's "description" value
 * @method DocumentType        setDocuments()     Sets the current record's "Documents" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDocumentType extends MyBaseRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('document_type');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('rank_priority', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('legal_value', 'string', 30, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 30,
             ));
        $this->hasColumn('description', 'clob', null, array(
             'type' => 'clob',
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Document as Documents', array(
             'local' => 'id',
             'foreign' => 'documenttype_id'));

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
        $this->actAs($timestampable0);
        $this->actAs($blameable0);
    }
}