<?php

/**
 * ClauseBodyVersion form base class.
 *
 * @method ClauseBodyVersion getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseClauseBodyVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'content'               => new sfWidgetFormTextarea(),
      'information_type_id'   => new sfWidgetFormInputText(),
      'operative_phrase_id'   => new sfWidgetFormInputText(),
      'clause_process_id'     => new sfWidgetFormInputText(),
      'public_comment'        => new sfWidgetFormTextarea(),
      'parent_clause_body_id' => new sfWidgetFormInputText(),
      'status'                => new sfWidgetFormChoice(array('choices' => array('draft' => 'draft', 'review' => 'review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
      'author_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'version'               => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'content'               => new sfValidatorString(array('required' => false)),
      'information_type_id'   => new sfValidatorInteger(array('required' => false)),
      'operative_phrase_id'   => new sfValidatorInteger(array('required' => false)),
      'clause_process_id'     => new sfValidatorInteger(array('required' => false)),
      'public_comment'        => new sfValidatorString(array('required' => false)),
      'parent_clause_body_id' => new sfValidatorInteger(array('required' => false)),
      'status'                => new sfValidatorChoice(array('choices' => array(0 => 'draft', 1 => 'review', 2 => 'reviewed', 3 => 'inactive', 4 => 'active'), 'required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
      'author_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'version'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'version', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clause_body_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClauseBodyVersion';
  }

}
