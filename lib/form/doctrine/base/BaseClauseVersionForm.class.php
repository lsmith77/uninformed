<?php

/**
 * ClauseVersion form base class.
 *
 * @method ClauseVersion getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseClauseVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'document_id'                => new sfWidgetFormInputText(),
      'clause_body_id'             => new sfWidgetFormInputText(),
      'clause_number_information'  => new sfWidgetFormInputText(),
      'clause_number_subparagraph' => new sfWidgetFormInputText(),
      'private_comment'            => new sfWidgetFormTextarea(),
      'created_at'                 => new sfWidgetFormDateTime(),
      'updated_at'                 => new sfWidgetFormDateTime(),
      'author_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'version'                    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'document_id'                => new sfValidatorInteger(),
      'clause_body_id'             => new sfValidatorInteger(),
      'clause_number_information'  => new sfValidatorString(array('max_length' => 255)),
      'clause_number_subparagraph' => new sfValidatorString(array('max_length' => 255)),
      'private_comment'            => new sfValidatorString(array('required' => false)),
      'created_at'                 => new sfValidatorDateTime(),
      'updated_at'                 => new sfValidatorDateTime(),
      'author_id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'version'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'version', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clause_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClauseVersion';
  }

}
