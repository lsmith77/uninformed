<?php

/**
 * Vote form base class.
 *
 * @method Vote getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseVoteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'type'        => new sfWidgetFormChoice(array('choices' => array('signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'))),
      'document_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => false)),
      'country_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => false)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'created_by'  => new sfWidgetFormInputText(),
      'version'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'type'        => new sfValidatorChoice(array('choices' => array('signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'), 'required' => false)),
      'document_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Document'))),
      'country_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'))),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'created_by'  => new sfValidatorInteger(),
      'version'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Vote', 'column' => array('document_id', 'country_id')))
    );

    $this->widgetSchema->setNameFormat('vote[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vote';
  }

}
