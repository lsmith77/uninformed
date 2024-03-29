<?php

/**
 * Clause form base class.
 *
 * @method Clause getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClauseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'document_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => false)),
      'is_latest_clause'           => new sfWidgetFormInputCheckbox(),
      'clause_body_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseBody'), 'add_empty' => false)),
      'clause_number'              => new sfWidgetFormInputText(),
      'clause_number_information'  => new sfWidgetFormInputText(),
      'clause_number_subparagraph' => new sfWidgetFormInputText(),
      'private_comment'            => new sfWidgetFormTextarea(),
      'slug'                       => new sfWidgetFormInputText(),
      'created_at'                 => new sfWidgetFormDateTime(),
      'updated_at'                 => new sfWidgetFormDateTime(),
      'author_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'document_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Document'))),
      'is_latest_clause'           => new sfValidatorBoolean(array('required' => false)),
      'clause_body_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseBody'))),
      'clause_number'              => new sfValidatorInteger(),
      'clause_number_information'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'clause_number_subparagraph' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'private_comment'            => new sfValidatorString(array('required' => false)),
      'slug'                       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'created_at'                 => new sfValidatorDateTime(),
      'updated_at'                 => new sfValidatorDateTime(),
      'author_id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Clause', 'column' => array('document_id', 'clause_body_id')))
    );

    $this->widgetSchema->setNameFormat('clause[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Clause';
  }

}
