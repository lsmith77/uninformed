<?php

/**
 * BaseTagImplication
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property enum $implication_type
 * @property integer $tag_id
 * @property integer $implied_tag_id
 * @property TaggableTag $Tag
 * @property TaggableTag $ImpliedTag
 * 
 * @method integer        getId()               Returns the current record's "id" value
 * @method enum           getImplicationType()  Returns the current record's "implication_type" value
 * @method integer        getTagId()            Returns the current record's "tag_id" value
 * @method integer        getImpliedTagId()     Returns the current record's "implied_tag_id" value
 * @method TaggableTag    getTag()              Returns the current record's "Tag" value
 * @method TaggableTag    getImpliedTag()       Returns the current record's "ImpliedTag" value
 * @method TagImplication setId()               Sets the current record's "id" value
 * @method TagImplication setImplicationType()  Sets the current record's "implication_type" value
 * @method TagImplication setTagId()            Sets the current record's "tag_id" value
 * @method TagImplication setImpliedTagId()     Sets the current record's "implied_tag_id" value
 * @method TagImplication setTag()              Sets the current record's "Tag" value
 * @method TagImplication setImpliedTag()       Sets the current record's "ImpliedTag" value
 * 
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7380 2010-03-15 21:07:50Z jwage $
 */
abstract class BaseTagImplication extends MyBaseRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tag_implication');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('implication_type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'implies',
              1 => 'suggests',
             ),
             'notnull' => true,
             ));
        $this->hasColumn('tag_id', 'integer', 8, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '8',
             ));
        $this->hasColumn('implied_tag_id', 'integer', 8, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '8',
             ));


        $this->index('mapping', array(
             'fields' => 
             array(
              0 => 'tag_id',
              1 => 'implied_tag_id',
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
        $this->hasOne('TaggableTag as Tag', array(
             'local' => 'tag_id',
             'foreign' => 'id'));

        $this->hasOne('TaggableTag as ImpliedTag', array(
             'local' => 'implied_tag_id',
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