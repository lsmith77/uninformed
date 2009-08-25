<?php

/**
 * Clause form base class.
 *
 * @package    form
 * @subpackage clause
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseClauseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'clause_id'        => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInput(),
      'document_id'      => new sfWidgetFormDoctrineChoice(array('model' => 'Document', 'add_empty' => false)),
      'clause_number'    => new sfWidgetFormInput(),
      'parent_clause_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Clause', 'add_empty' => true)),
      'information_type' => new sfWidgetFormInput(),
      'operative_phrase' => new sfWidgetFormInput(),
      'adressee'         => new sfWidgetFormInput(),
      'relevance'        => new sfWidgetFormInput(),
      'significants'     => new sfWidgetFormInput(),
      'content'          => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'tags_list'        => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Tag')),
    ));

    $this->setValidators(array(
      'clause_id'        => new sfValidatorDoctrineChoice(array('model' => 'Clause', 'column' => 'clause_id', 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 45)),
      'document_id'      => new sfValidatorDoctrineChoice(array('model' => 'Document')),
      'clause_number'    => new sfValidatorInteger(),
      'parent_clause_id' => new sfValidatorDoctrineChoice(array('model' => 'Clause', 'required' => false)),
      'information_type' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'operative_phrase' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'adressee'         => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'relevance'        => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'significants'     => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'content'          => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
      'tags_list'        => new sfValidatorDoctrineChoiceMany(array('model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clause[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Clause';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['tags_list']))
    {
      $this->setDefault('tags_list', $this->object->Tags->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveTagsList($con);
  }

  public function saveTagsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tags_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Tags->getPrimaryKeys();
    $values = $this->getValue('tags_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Tags', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Tags', array_values($link));
    }
  }

}
