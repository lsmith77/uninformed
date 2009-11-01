<?php

/**
 * Document form base class.
 *
 * @package    form
 * @subpackage document
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseDocumentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_id'            => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInput(),
      'publication_date'       => new sfWidgetFormDate(),
      'adoption_date'          => new sfWidgetFormDate(),
      'code'                   => new sfWidgetFormInput(),
      'min_ratification_count' => new sfWidgetFormInput(),
      'preamble'               => new sfWidgetFormTextarea(),
      'parent_id'              => new sfWidgetFormDoctrineChoice(array('model' => 'Document', 'add_empty' => true)),
      'organisation_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'Organisation', 'add_empty' => true)),
      'documenttype_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'DocumentType', 'add_empty' => true)),
      'documentURL'            => new sfWidgetFormInput(),
      'import_id'              => new sfWidgetFormDoctrineChoice(array('model' => 'Import', 'add_empty' => false)),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'tags_list'              => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Tag')),
    ));

    $this->setValidators(array(
      'document_id'            => new sfValidatorDoctrineChoice(array('model' => 'Document', 'column' => 'document_id', 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 255)),
      'publication_date'       => new sfValidatorDate(array('required' => false)),
      'adoption_date'          => new sfValidatorDate(),
      'code'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'min_ratification_count' => new sfValidatorInteger(array('required' => false)),
      'preamble'               => new sfValidatorString(array('required' => false)),
      'parent_id'              => new sfValidatorDoctrineChoice(array('model' => 'Document', 'required' => false)),
      'organisation_id'        => new sfValidatorDoctrineChoice(array('model' => 'Organisation', 'required' => false)),
      'documenttype_id'        => new sfValidatorDoctrineChoice(array('model' => 'DocumentType', 'required' => false)),
      'documentURL'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'import_id'              => new sfValidatorDoctrineChoice(array('model' => 'Import')),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
      'tags_list'              => new sfValidatorDoctrineChoiceMany(array('model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Document';
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
