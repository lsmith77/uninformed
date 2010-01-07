<?php

/**
 * CountryOrganisationVersion form base class.
 *
 * @method CountryOrganisationVersion getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCountryOrganisationVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'join_date'       => new sfWidgetFormDate(),
      'leave_date'      => new sfWidgetFormDate(),
      'country_id'      => new sfWidgetFormInputText(),
      'organisation_id' => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'author_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'version'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'join_date'       => new sfValidatorDate(),
      'leave_date'      => new sfValidatorDate(array('required' => false)),
      'country_id'      => new sfValidatorInteger(),
      'organisation_id' => new sfValidatorInteger(),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'author_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'version'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'version', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('country_organisation_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CountryOrganisationVersion';
  }

}
