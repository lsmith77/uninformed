<?php

/**
 * Document form base class.
 *
 * @method Document getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'title'                  => new sfWidgetFormTextarea(),
      'slug'                   => new sfWidgetFormInputText(),
      'enforcement_date'       => new sfWidgetFormDate(),
      'adoption_date'          => new sfWidgetFormDate(),
      'code'                   => new sfWidgetFormInputText(),
      'min_ratification_count' => new sfWidgetFormInputText(),
      'is_ratified'            => new sfWidgetFormInputCheckbox(),
      'vote_url'               => new sfWidgetFormTextarea(),
      'private_comment'        => new sfWidgetFormTextarea(),
      'public_comment'         => new sfWidgetFormTextarea(),
      'parent_document_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentParent'), 'add_empty' => true)),
      'root_document_id'       => new sfWidgetFormInputText(),
      'organisation_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organisation'), 'add_empty' => true)),
      'documenttype_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'add_empty' => true)),
      'document_url'           => new sfWidgetFormTextarea(),
      'status'                 => new sfWidgetFormChoice(array('choices' => array('draft' => 'draft', 'review' => 'review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'author_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'tags_list'              => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tag')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'                  => new sfValidatorString(array('max_length' => 1000)),
      'slug'                   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'enforcement_date'       => new sfValidatorDate(array('required' => false)),
      'adoption_date'          => new sfValidatorDate(),
      'code'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'min_ratification_count' => new sfValidatorInteger(array('required' => false)),
      'is_ratified'            => new sfValidatorBoolean(array('required' => false)),
      'vote_url'               => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'private_comment'        => new sfValidatorString(array('required' => false)),
      'public_comment'         => new sfValidatorString(array('required' => false)),
      'parent_document_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentParent'), 'required' => false)),
      'root_document_id'       => new sfValidatorInteger(array('required' => false)),
      'organisation_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organisation'), 'required' => false)),
      'documenttype_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'required' => false)),
      'document_url'           => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'status'                 => new sfValidatorChoice(array('choices' => array(0 => 'draft', 1 => 'review', 2 => 'reviewed', 3 => 'inactive', 4 => 'active'), 'required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
      'author_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'tags_list'              => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
    $this->saveTagsList($con);

    parent::doSave($con);
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

    if (null === $con)
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
