<?php

/**
 * Vote form base class.
 *
 * @method Vote getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVoteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'type'        => new sfWidgetFormChoice(array('choices' => array('adopted without a vote' => 'adopted without a vote', 'yes' => 'yes', 'no' => 'no', 'abstention' => 'abstention', 'not present' => 'not present', 'signed' => 'signed', 'ratified' => 'ratified'))),
      'vote_date'   => new sfWidgetFormInputText(),
      'document_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => false)),
      'country_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => false)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'author_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'type'        => new sfValidatorChoice(array('choices' => array(0 => 'adopted without a vote', 1 => 'yes', 2 => 'no', 3 => 'abstention', 4 => 'not present', 5 => 'signed', 6 => 'ratified'), 'required' => false)),
      'vote_date'   => new sfValidatorPass(array('required' => false)),
      'document_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Document'))),
      'country_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'))),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'author_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
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
