<?php

/**
 * DocumentReservation form base class.
 *
 * @method DocumentReservation getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDocumentReservationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'document_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => true)),
      'country_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'reservation' => new sfWidgetFormTextarea(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'author_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'version'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'document_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'required' => false)),
      'country_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'required' => false)),
      'reservation' => new sfValidatorString(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'author_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'version'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'DocumentReservation', 'column' => array('document_id', 'country_id')))
    );

    $this->widgetSchema->setNameFormat('document_reservation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentReservation';
  }

}
