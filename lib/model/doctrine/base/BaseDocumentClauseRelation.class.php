<?php

/**
 * BaseDocumentClauseRelation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $document_id
 * @property integer $related_clause_body_id
 * @property Document $Document
 * @property ClauseBody $ClauseRelated
 * 
 * @method integer                getId()                     Returns the current record's "id" value
 * @method integer                getDocumentId()             Returns the current record's "document_id" value
 * @method integer                getRelatedClauseBodyId()    Returns the current record's "related_clause_body_id" value
 * @method Document               getDocument()               Returns the current record's "Document" value
 * @method ClauseBody             getClauseRelated()          Returns the current record's "ClauseRelated" value
 * @method DocumentClauseRelation setId()                     Sets the current record's "id" value
 * @method DocumentClauseRelation setDocumentId()             Sets the current record's "document_id" value
 * @method DocumentClauseRelation setRelatedClauseBodyId()    Sets the current record's "related_clause_body_id" value
 * @method DocumentClauseRelation setDocument()               Sets the current record's "Document" value
 * @method DocumentClauseRelation setClauseRelated()          Sets the current record's "ClauseRelated" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDocumentClauseRelation extends MyBaseRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('document_clause_relation');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('document_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('related_clause_body_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));


        $this->index('mapping', array(
             'fields' => 
             array(
              0 => 'document_id',
              1 => 'related_clause_body_id',
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

        $this->hasOne('ClauseBody as ClauseRelated', array(
             'local' => 'related_clause_body_id',
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
        $this->actAs($timestampable0);
        $this->actAs($blameable0);
    }
}