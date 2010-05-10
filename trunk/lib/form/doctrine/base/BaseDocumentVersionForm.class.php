<?php

/**
 * DocumentVersion form base class.
 *
 * @method DocumentVersion getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDocumentVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInputText(),
      'slug'                   => new sfWidgetFormInputText(),
      'enforcement_date'       => new sfWidgetFormDate(),
      'adoption_date'          => new sfWidgetFormDate(),
      'code'                   => new sfWidgetFormInputText(),
      'min_ratification_count' => new sfWidgetFormInputText(),
      'is_ratified'            => new sfWidgetFormInputText(),
      'vote_url'               => new sfWidgetFormInputText(),
      'private_comment'        => new sfWidgetFormTextarea(),
      'public_comment'         => new sfWidgetFormTextarea(),
      'parent_document_id'     => new sfWidgetFormInputText(),
      'organisation_id'        => new sfWidgetFormInputText(),
      'documenttype_id'        => new sfWidgetFormInputText(),
      'document_url'           => new sfWidgetFormInputText(),
      'clause_ordering'        => new sfWidgetFormInputText(),
      'status'                 => new sfWidgetFormChoice(array('choices' => array('draft' => 'draft', 'review' => 'review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'author_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'version'                => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 255)),
      'slug'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'enforcement_date'       => new sfValidatorDate(array('required' => false)),
      'adoption_date'          => new sfValidatorDate(),
      'code'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'min_ratification_count' => new sfValidatorInteger(array('required' => false)),
      'is_ratified'            => new sfValidatorPass(array('required' => false)),
      'vote_url'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'private_comment'        => new sfValidatorString(array('required' => false)),
      'public_comment'         => new sfValidatorString(array('required' => false)),
      'parent_document_id'     => new sfValidatorInteger(array('required' => false)),
      'organisation_id'        => new sfValidatorInteger(array('required' => false)),
      'documenttype_id'        => new sfValidatorInteger(array('required' => false)),
      'document_url'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'clause_ordering'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'status'                 => new sfValidatorChoice(array('choices' => array(0 => 'draft', 1 => 'review', 2 => 'reviewed', 3 => 'inactive', 4 => 'active'), 'required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
      'author_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'version'                => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'version', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentVersion';
  }

}
