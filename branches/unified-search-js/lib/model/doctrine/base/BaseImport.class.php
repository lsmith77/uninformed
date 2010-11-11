<?php

/**
 * BaseImport
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property ExcelFile $ExcelFile
 * 
 * @method ExcelFile getExcelFile() Returns the current record's "ExcelFile" value
 * @method Import    setExcelFile() Sets the current record's "ExcelFile" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseImport extends sfGuardUser
{
    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ExcelFile', array(
             'local' => 'excel_file_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
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
        $this->actAs($softdelete0);
        $this->actAs($blameable0);
    }
}