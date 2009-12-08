<?php

/**
 * Tag form base class.
 *
 * @package    form
 * @subpackage tag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tag_id'               => new sfWidgetFormInputHidden(),
      'name'                 => new sfWidgetFormInput(),
      'tag_type'             => new sfWidgetFormChoice(array('choices' => array('' => '', 'legal_measure' => 'legal_measure'))),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'clauses_list'         => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Clause')),
      'documents_list'       => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Document')),
      'tag_hierarchies_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'TagHierarchie')),
    ));

    $this->setValidators(array(
      'tag_id'               => new sfValidatorDoctrineChoice(array('model' => 'Tag', 'column' => 'tag_id', 'required' => false)),
      'name'                 => new sfValidatorString(array('max_length' => 255)),
      'tag_type'             => new sfValidatorChoice(array('choices' => array('' => '', 'legal_measure' => 'legal_measure'))),
      'created_at'           => new sfValidatorDateTime(array('required' => false)),
      'updated_at'           => new sfValidatorDateTime(array('required' => false)),
      'clauses_list'         => new sfValidatorDoctrineChoiceMany(array('model' => 'Clause', 'required' => false)),
      'documents_list'       => new sfValidatorDoctrineChoiceMany(array('model' => 'Document', 'required' => false)),
      'tag_hierarchies_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'TagHierarchie', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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

    if (isset($this->widgetSchema['tag_hierarchies_list']))
    {
      $this->setDefault('tag_hierarchies_list', $this->object->TagHierarchies->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveClausesList($con);
    $this->saveDocumentsList($con);
    $this->saveTagHierarchiesList($con);
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

    if (is_null($con))
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

    if (is_null($con))
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

  public function saveTagHierarchiesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tag_hierarchies_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->TagHierarchies->getPrimaryKeys();
    $values = $this->getValue('tag_hierarchies_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('TagHierarchies', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('TagHierarchies', array_values($link));
    }
  }

}
