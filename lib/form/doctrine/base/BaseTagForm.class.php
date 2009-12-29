<?php

/**
 * Tag form base class.
 *
 * @method Tag getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'created_by'       => new sfWidgetFormInputText(),
      'version'          => new sfWidgetFormInputText(),
      'clauses_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ClauseBody')),
      'documents_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Document')),
      'document_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Document')),
      'clause_body_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ClauseBody')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 255)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'created_by'       => new sfValidatorInteger(),
      'version'          => new sfValidatorInteger(array('required' => false)),
      'clauses_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ClauseBody', 'required' => false)),
      'documents_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Document', 'required' => false)),
      'document_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Document', 'required' => false)),
      'clause_body_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ClauseBody', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tag';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['clauses_list']))
    {
      $this->setDefault('clauses_list', $this->object->Clauses->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['documents_list']))
    {
      $this->setDefault('documents_list', $this->object->Documents->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['document_list']))
    {
      $this->setDefault('document_list', $this->object->Document->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['clause_body_list']))
    {
      $this->setDefault('clause_body_list', $this->object->ClauseBody->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveClausesList($con);
    $this->saveDocumentsList($con);
    $this->saveDocumentList($con);
    $this->saveClauseBodyList($con);

    parent::doSave($con);
  }

  public function saveClausesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['clauses_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Clauses->getPrimaryKeys();
    $values = $this->getValue('clauses_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Clauses', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Clauses', array_values($link));
    }
  }

  public function saveDocumentsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['documents_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Documents->getPrimaryKeys();
    $values = $this->getValue('documents_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Documents', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Documents', array_values($link));
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

}
