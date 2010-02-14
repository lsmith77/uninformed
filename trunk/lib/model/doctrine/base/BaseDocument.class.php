<?php

/**
 * BaseDocument
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property date $publication_date
 * @property date $adoption_date
 * @property string $code
 * @property integer $min_ratification_count
 * @property bool $is_ratified
 * @property clob $private_comment
 * @property clob $public_comment
 * @property integer $parent_document_id
 * @property integer $organisation_id
 * @property integer $documenttype_id
 * @property string $document_url
 * @property string $clause_ordering
 * @property enum $status
 * @property Document $Parent
 * @property Organisation $Organisation
 * @property DocumentType $DocumentType
 * @property Doctrine_Collection $Subdocuments
 * @property Doctrine_Collection $DocumentDocumentRelation
 * @property Doctrine_Collection $DocumentClauseRelation
 * @property Doctrine_Collection $Clauses
 * @property Doctrine_Collection $Votes
 * 
 * @method integer             getId()                       Returns the current record's "id" value
 * @method string              getName()                     Returns the current record's "name" value
 * @method string              getSlug()                     Returns the current record's "slug" value
 * @method date                getPublicationDate()          Returns the current record's "publication_date" value
 * @method date                getAdoptionDate()             Returns the current record's "adoption_date" value
 * @method string              getCode()                     Returns the current record's "code" value
 * @method integer             getMinRatificationCount()     Returns the current record's "min_ratification_count" value
 * @method bool                getIsRatified()               Returns the current record's "is_ratified" value
 * @method clob                getPrivateComment()           Returns the current record's "private_comment" value
 * @method clob                getPublicComment()            Returns the current record's "public_comment" value
 * @method integer             getParentDocumentId()         Returns the current record's "parent_document_id" value
 * @method integer             getOrganisationId()           Returns the current record's "organisation_id" value
 * @method integer             getDocumenttypeId()           Returns the current record's "documenttype_id" value
 * @method string              getDocumentUrl()              Returns the current record's "document_url" value
 * @method string              getClauseOrdering()           Returns the current record's "clause_ordering" value
 * @method enum                getStatus()                   Returns the current record's "status" value
 * @method Document            getParent()                   Returns the current record's "Parent" value
 * @method Organisation        getOrganisation()             Returns the current record's "Organisation" value
 * @method DocumentType        getDocumentType()             Returns the current record's "DocumentType" value
 * @method Doctrine_Collection getSubdocuments()             Returns the current record's "Subdocuments" collection
 * @method Doctrine_Collection getDocumentDocumentRelation() Returns the current record's "DocumentDocumentRelation" collection
 * @method Doctrine_Collection getDocumentClauseRelation()   Returns the current record's "DocumentClauseRelation" collection
 * @method Doctrine_Collection getClauses()                  Returns the current record's "Clauses" collection
 * @method Doctrine_Collection getVotes()                    Returns the current record's "Votes" collection
 * @method Document            setId()                       Sets the current record's "id" value
 * @method Document            setName()                     Sets the current record's "name" value
 * @method Document            setSlug()                     Sets the current record's "slug" value
 * @method Document            setPublicationDate()          Sets the current record's "publication_date" value
 * @method Document            setAdoptionDate()             Sets the current record's "adoption_date" value
 * @method Document            setCode()                     Sets the current record's "code" value
 * @method Document            setMinRatificationCount()     Sets the current record's "min_ratification_count" value
 * @method Document            setIsRatified()               Sets the current record's "is_ratified" value
 * @method Document            setPrivateComment()           Sets the current record's "private_comment" value
 * @method Document            setPublicComment()            Sets the current record's "public_comment" value
 * @method Document            setParentDocumentId()         Sets the current record's "parent_document_id" value
 * @method Document            setOrganisationId()           Sets the current record's "organisation_id" value
 * @method Document            setDocumenttypeId()           Sets the current record's "documenttype_id" value
 * @method Document            setDocumentUrl()              Sets the current record's "document_url" value
 * @method Document            setClauseOrdering()           Sets the current record's "clause_ordering" value
 * @method Document            setStatus()                   Sets the current record's "status" value
 * @method Document            setParent()                   Sets the current record's "Parent" value
 * @method Document            setOrganisation()             Sets the current record's "Organisation" value
 * @method Document            setDocumentType()             Sets the current record's "DocumentType" value
 * @method Document            setSubdocuments()             Sets the current record's "Subdocuments" collection
 * @method Document            setDocumentDocumentRelation() Sets the current record's "DocumentDocumentRelation" collection
 * @method Document            setDocumentClauseRelation()   Sets the current record's "DocumentClauseRelation" collection
 * @method Document            setClauses()                  Sets the current record's "Clauses" collection
 * @method Document            setVotes()                    Sets the current record's "Votes" collection
 * 
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseDocument extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('document');
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
        $this->hasColumn('slug', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('publication_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('adoption_date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('code', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('min_ratification_count', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('is_ratified', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('private_comment', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('public_comment', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('parent_document_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('organisation_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('documenttype_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('document_url', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('clause_ordering', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('status', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'draft',
              1 => 'review',
              2 => 'reviewed',
              3 => 'inactive',
              4 => 'active',
             ),
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Document as Parent', array(
             'local' => 'parent_document_id',
             'foreign' => 'id'));

        $this->hasOne('Organisation', array(
             'local' => 'organisation_id',
             'foreign' => 'id'));

        $this->hasOne('DocumentType', array(
             'local' => 'documenttype_id',
             'foreign' => 'id'));

        $this->hasMany('Document as Subdocuments', array(
             'local' => 'id',
             'foreign' => 'parent_document_id'));

        $this->hasMany('DocumentDocumentRelation', array(
             'local' => 'id',
             'foreign' => 'document_id'));

        $this->hasMany('DocumentClauseRelation', array(
             'local' => 'id',
             'foreign' => 'document_id'));

        $this->hasMany('Clause as Clauses', array(
             'local' => 'id',
             'foreign' => 'document_id'));

        $this->hasMany('Vote as Votes', array(
             'local' => 'id',
             'foreign' => 'document_id'));

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
        $taggable0 = new Doctrine_Template_Taggable();
        $this->actAs($timestampable0);
        $this->actAs($blameable0);
        $this->actAs($versionable0);
        $this->actAs($taggable0);
    }
}