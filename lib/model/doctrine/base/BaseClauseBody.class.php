<?php

/**
 * BaseClauseBody
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property clob $content
 * @property integer $information_type_id
 * @property integer $operative_phrase_id
 * @property integer $clause_process_id
 * @property clob $public_comment
 * @property integer $parent_clause_body_id
 * @property enum $status
 * @property Addressee $Addressees
 * @property Doctrine_Collection $Tag
 * 
 * @method integer               getId()                     Returns the current record's "id" value
 * @method clob                  getContent()                Returns the current record's "content" value
 * @method integer               getInformationTypeId()      Returns the current record's "information_type_id" value
 * @method integer               getOperativePhraseId()      Returns the current record's "operative_phrase_id" value
 * @method integer               getClauseProcessId()        Returns the current record's "clause_process_id" value
 * @method clob                  getPublicComment()          Returns the current record's "public_comment" value
 * @method integer               getParentClauseBodyId()     Returns the current record's "parent_clause_body_id" value
 * @method enum                  getStatus()                 Returns the current record's "status" value
 * @method Addressee             getAddressees()             Returns the current record's "Addressees" value
 * @method Doctrine_Collection   getTags()                   Returns the current record's "Tags" collection
 * @method ClauseBody            getClauseBodyParent()       Returns the current record's "ClauseBodyParent" value
 * @method ClauseProcess         getClauseProcess()          Returns the current record's "ClauseProcess" value
 * @method ClauseInformationType getClauseInformationType()  Returns the current record's "ClauseInformationType" value
 * @method ClauseOperativePhrase getClauseOperativePhrase()  Returns the current record's "ClauseOperativePhrase" value
 * @method Doctrine_Collection   getAddressee()              Returns the current record's "Addressee" collection
 * @method Doctrine_Collection   getDocumentClauseRelation() Returns the current record's "DocumentClauseRelation" collection
 * @method Doctrine_Collection   getClause()                 Returns the current record's "Clause" collection
 * @method Doctrine_Collection   getSubclauses()             Returns the current record's "Subclauses" collection
 * @method Doctrine_Collection   getClauseReservation()      Returns the current record's "ClauseReservation" collection
 * @method Doctrine_Collection   getTag()                    Returns the current record's "Tag" collection
 * @method ClauseBody            setId()                     Sets the current record's "id" value
 * @method ClauseBody            setContent()                Sets the current record's "content" value
 * @method ClauseBody            setInformationTypeId()      Sets the current record's "information_type_id" value
 * @method ClauseBody            setOperativePhraseId()      Sets the current record's "operative_phrase_id" value
 * @method ClauseBody            setClauseProcessId()        Sets the current record's "clause_process_id" value
 * @method ClauseBody            setPublicComment()          Sets the current record's "public_comment" value
 * @method ClauseBody            setParentClauseBodyId()     Sets the current record's "parent_clause_body_id" value
 * @method ClauseBody            setStatus()                 Sets the current record's "status" value
 * @method ClauseBody            setAddressees()             Sets the current record's "Addressees" value
 * @method ClauseBody            setTags()                   Sets the current record's "Tags" collection
 * @method ClauseBody            setClauseBodyParent()       Sets the current record's "ClauseBodyParent" value
 * @method ClauseBody            setClauseProcess()          Sets the current record's "ClauseProcess" value
 * @method ClauseBody            setClauseInformationType()  Sets the current record's "ClauseInformationType" value
 * @method ClauseBody            setClauseOperativePhrase()  Sets the current record's "ClauseOperativePhrase" value
 * @method ClauseBody            setAddressee()              Sets the current record's "Addressee" collection
 * @method ClauseBody            setDocumentClauseRelation() Sets the current record's "DocumentClauseRelation" collection
 * @method ClauseBody            setClause()                 Sets the current record's "Clause" collection
 * @method ClauseBody            setSubclauses()             Sets the current record's "Subclauses" collection
 * @method ClauseBody            setClauseReservation()      Sets the current record's "ClauseReservation" collection
 * @method ClauseBody            setTag()                    Sets the current record's "Tag" collections
 * @property ClauseBody $ClauseBodyParent
 * @property ClauseProcess $ClauseProcess
 * @property ClauseInformationType $ClauseInformationType
 * @property ClauseOperativePhrase $ClauseOperativePhrase
 * @property Doctrine_Collection $Addressee
 * @property Doctrine_Collection $DocumentClauseRelation
 * @property Doctrine_Collection $Clause
 * @property Doctrine_Collection $Subclauses
 * @property Doctrine_Collection $ClauseReservation
 * @property Doctrine_Collection $Tag
 * 
 * @method integer               getId()                     Returns the current record's "id" value
 * @method clob                  getContent()                Returns the current record's "content" value
 * @method integer               getInformationTypeId()      Returns the current record's "information_type_id" value
 * @method integer               getOperativePhraseId()      Returns the current record's "operative_phrase_id" value
 * @method integer               getClauseProcessId()        Returns the current record's "clause_process_id" value
 * @method clob                  getPublicComment()          Returns the current record's "public_comment" value
 * @method integer               getParentClauseBodyId()     Returns the current record's "parent_clause_body_id" value
 * @method enum                  getStatus()                 Returns the current record's "status" value
 * @method Addressee             getAddressees()             Returns the current record's "Addressees" value
 * @method Doctrine_Collection   getTags()                   Returns the current record's "Tags" collection
 * @method ClauseBody            getClauseBodyParent()       Returns the current record's "ClauseBodyParent" value
 * @method ClauseProcess         getClauseProcess()          Returns the current record's "ClauseProcess" value
 * @method ClauseInformationType getClauseInformationType()  Returns the current record's "ClauseInformationType" value
 * @method ClauseOperativePhrase getClauseOperativePhrase()  Returns the current record's "ClauseOperativePhrase" value
 * @method Doctrine_Collection   getAddressee()              Returns the current record's "Addressee" collection
 * @method Doctrine_Collection   getDocumentClauseRelation() Returns the current record's "DocumentClauseRelation" collection
 * @method Doctrine_Collection   getClause()                 Returns the current record's "Clause" collection
 * @method Doctrine_Collection   getSubclauses()             Returns the current record's "Subclauses" collection
 * @method Doctrine_Collection   getClauseReservation()      Returns the current record's "ClauseReservation" collection
 * @method Doctrine_Collection   getTag()                    Returns the current record's "Tag" collection
 * @method ClauseBody            setId()                     Sets the current record's "id" value
 * @method ClauseBody            setContent()                Sets the current record's "content" value
 * @method ClauseBody            setInformationTypeId()      Sets the current record's "information_type_id" value
 * @method ClauseBody            setOperativePhraseId()      Sets the current record's "operative_phrase_id" value
 * @method ClauseBody            setClauseProcessId()        Sets the current record's "clause_process_id" value
 * @method ClauseBody            setPublicComment()          Sets the current record's "public_comment" value
 * @method ClauseBody            setParentClauseBodyId()     Sets the current record's "parent_clause_body_id" value
 * @method ClauseBody            setStatus()                 Sets the current record's "status" value
 * @method ClauseBody            setAddressees()             Sets the current record's "Addressees" value
 * @method ClauseBody            setTags()                   Sets the current record's "Tags" collection
 * @method ClauseBody            setClauseBodyParent()       Sets the current record's "ClauseBodyParent" value
 * @method ClauseBody            setClauseProcess()          Sets the current record's "ClauseProcess" value
 * @method ClauseBody            setClauseInformationType()  Sets the current record's "ClauseInformationType" value
 * @method ClauseBody            setClauseOperativePhrase()  Sets the current record's "ClauseOperativePhrase" value
 * @method ClauseBody            setAddressee()              Sets the current record's "Addressee" collection
 * @method ClauseBody            setDocumentClauseRelation() Sets the current record's "DocumentClauseRelation" collection
 * @method ClauseBody            setClause()                 Sets the current record's "Clause" collection
 * @method ClauseBody            setSubclauses()             Sets the current record's "Subclauses" collection
 * @method ClauseBody            setClauseReservation()      Sets the current record's "ClauseReservation" collection
 * @method ClauseBody            setTag()                    Sets the current record's "Tag" collection
 * 
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseClauseBody extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('clause_body');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('content', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('information_type_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('operative_phrase_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('clause_process_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('public_comment', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('parent_clause_body_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('status', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'draft',
              1 => 'in_review',
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
        $this->hasOne('Addressee as Addressees', array(
             'local' => 'id',
             'foreign' => 'id'));

        $this->hasMany('Tag as Tags', array(
             'refClass' => 'ClauseTag',
             'local' => 'id',
             'foreign' => 'id'));

        $this->hasOne('ClauseBody as ClauseBodyParent', array(
             'local' => 'parent_clause_body_id',
             'foreign' => 'id'));

        $this->hasOne('ClauseProcess', array(
             'local' => 'clause_process_id',
             'foreign' => 'id'));

        $this->hasOne('ClauseInformationType', array(
             'local' => 'information_type_id',
             'foreign' => 'id'));

        $this->hasOne('ClauseOperativePhrase', array(
             'local' => 'operative_phrase_id',
             'foreign' => 'id'));

        $this->hasMany('Addressee', array(
             'refClass' => 'ClauseAddressee',
             'local' => 'id',
             'foreign' => 'id'));

        $this->hasMany('DocumentClauseRelation', array(
             'local' => 'id',
             'foreign' => 'related_clause_body_id'));

        $this->hasMany('Clause', array(
             'local' => 'id',
             'foreign' => 'clause_body_id'));

        $this->hasMany('ClauseBody as Subclauses', array(
             'local' => 'id',
             'foreign' => 'parent_clause_body_id'));

        $this->hasMany('ClauseReservation', array(
             'local' => 'id',
             'foreign' => 'clause_body_id'));

        $this->hasMany('Tag', array(
             'refClass' => 'ClauseTag',
             'local' => 'id',
             'foreign' => 'tag_id'));

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
        $this->actAs($timestampable0);
        $this->actAs($blameable0);
        $this->actAs($versionable0);
    }
}