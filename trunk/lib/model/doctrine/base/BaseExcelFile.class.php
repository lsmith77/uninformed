<?php

/**
 * BaseExcelFile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property integer $tag_id
 * @property string $file
 * @property boolean $is_imported
 * @property Tag $Tag
 * 
 * @method integer   getId()          Returns the current record's "id" value
 * @method string    getName()        Returns the current record's "name" value
 * @method integer   getTagId()       Returns the current record's "tag_id" value
 * @method string    getFile()        Returns the current record's "file" value
 * @method boolean   getIsImported()  Returns the current record's "is_imported" value
 * @method Tag       getTag()         Returns the current record's "Tag" value
 * @method ExcelFile setId()          Sets the current record's "id" value
 * @method ExcelFile setName()        Sets the current record's "name" value
 * @method ExcelFile setTagId()       Sets the current record's "tag_id" value
 * @method ExcelFile setFile()        Sets the current record's "file" value
 * @method ExcelFile setIsImported()  Sets the current record's "is_imported" value
 * @method ExcelFile setTag()         Sets the current record's "Tag" value
 * 
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseExcelFile extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('excel_file');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('tag_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('file', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('is_imported', 'boolean', null, array(
             'type' => 'boolean',
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Tag', array(
             'local' => 'tag_id',
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