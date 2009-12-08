<?php

/**
 * Organisation form base class.
 *
 * @package    form
 * @subpackage organisation
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseOrganisationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'organisation_id' => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInput(),
      'parent_id'       => new sfWidgetFormDoctrineChoice(array('model' => 'Organisation', 'add_empty' => true)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'organisation_id' => new sfValidatorDoctrineChoice(array('model' => 'Organisation', 'column' => 'organisation_id', 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 255)),
      'parent_id'       => new sfValidatorDoctrineChoice(array('model' => 'Organisation', 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('organisation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organisation';
  }

}
