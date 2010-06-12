<?php

/**
 * ClauseReservation form base class.
 *
 * @method ClauseReservation getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClauseReservationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'clause_body_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Clause'), 'add_empty' => true)),
      'country_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'reservation'    => new sfWidgetFormTextarea(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'author_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'clause_body_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Clause'), 'required' => false)),
      'country_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'required' => false)),
      'reservation'    => new sfValidatorString(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'author_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ClauseReservation', 'column' => array('clause_body_id', 'country_id')))
    );

    $this->widgetSchema->setNameFormat('clause_reservation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClauseReservation';
  }

}
