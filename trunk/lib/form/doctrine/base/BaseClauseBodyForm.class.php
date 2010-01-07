<?php

/**
 * ClauseBody form base class.
 *
 * @method ClauseBody getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseClauseBodyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'content'               => new sfWidgetFormTextarea(),
      'information_type_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseInformationType'), 'add_empty' => true)),
      'operative_phrase_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseOperativePhrase'), 'add_empty' => true)),
      'clause_process_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseProcess'), 'add_empty' => true)),
      'public_comment'        => new sfWidgetFormTextarea(),
      'parent_clause_body_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseBodyParent'), 'add_empty' => true)),
      'status'                => new sfWidgetFormChoice(array('choices' => array('draft' => 'draft', 'in_review' => 'in_review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
      'author_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'version'               => new sfWidgetFormInputText(),
      'tags_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tag')),
      'addressee_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Addressee')),
      'tag_list'              => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tag')),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'content'               => new sfValidatorString(array('required' => false)),
      'information_type_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseInformationType'), 'required' => false)),
      'operative_phrase_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseOperativePhrase'), 'required' => false)),
      'clause_process_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseProcess'), 'required' => false)),
      'public_comment'        => new sfValidatorString(array('required' => false)),
      'parent_clause_body_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseBodyParent'), 'required' => false)),
      'status'                => new sfValidatorChoice(array('choices' => array('draft' => 'draft', 'in_review' => 'in_review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'), 'required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
      'author_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'version'               => new sfValidatorInteger(array('required' => false)),
      'tags_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
      'addressee_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Addressee', 'required' => false)),
      'tag_list'              => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clause_body[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClauseBody';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['tags_list']))
    {
      $this->setDefault('tags_list', $this->object->Tags->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['addressee_list']))
    {
      $this->setDefault('addressee_list', $this->object->Addressee->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['tag_list']))
    {
      $this->setDefault('tag_list', $this->object->Tag->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveTagsList($con);
    $this->saveAddresseeList($con);
    $this->saveTagList($con);

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

  public function saveAddresseeList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['addressee_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Addressee->getPrimaryKeys();
    $values = $this->getValue('addressee_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Addressee', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Addressee', array_values($link));
    }
  }

  public function saveTagList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tag_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Tag->getPrimaryKeys();
    $values = $this->getValue('tag_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Tag', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Tag', array_values($link));
    }
  }

}
