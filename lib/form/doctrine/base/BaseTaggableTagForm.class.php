<?php

/**
 * TaggableTag form base class.
 *
 * @method TaggableTag getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTaggableTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'clause_body_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ClauseBody')),
      'document_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Document')),
      'excel_file_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ExcelFile')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'clause_body_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ClauseBody', 'required' => false)),
      'document_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Document', 'required' => false)),
      'excel_file_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ExcelFile', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'TaggableTag', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('taggable_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TaggableTag';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['clause_body_list']))
    {
      $this->setDefault('clause_body_list', $this->object->ClauseBody->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['document_list']))
    {
      $this->setDefault('document_list', $this->object->Document->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['excel_file_list']))
    {
      $this->setDefault('excel_file_list', $this->object->ExcelFile->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveClauseBodyList($con);
    $this->saveDocumentList($con);
    $this->saveExcelFileList($con);

    parent::doSave($con);
  }

  public function saveClauseBodyList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['clause_body_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ClauseBody->getPrimaryKeys();
    $values = $this->getValue('clause_body_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ClauseBody', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ClauseBody', array_values($link));
    }
  }

  public function saveDocumentList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['document_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Document->getPrimaryKeys();
    $values = $this->getValue('document_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Document', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Document', array_values($link));
    }
  }

  public function saveExcelFileList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['excel_file_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ExcelFile->getPrimaryKeys();
    $values = $this->getValue('excel_file_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ExcelFile', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ExcelFile', array_values($link));
    }
  }

}
