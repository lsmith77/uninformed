<?php

/**
 * MemberstateOrganisation form base class.
 *
 * @package    form
 * @subpackage memberstate_organisation
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMemberstateOrganisationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'join_date'       => new sfWidgetFormDate(),
      'leave_date'      => new sfWidgetFormDate(),
      'memberstate_id'  => new sfWidgetFormDoctrineChoice(array('model' => 'Memberstate', 'add_empty' => true)),
      'organisation_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Organisation', 'add_empty' => true)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => 'MemberstateOrganisation', 'column' => 'id', 'required' => false)),
      'join_date'       => new sfValidatorDate(),
      'leave_date'      => new sfValidatorDate(array('required' => false)),
      'memberstate_id'  => new sfValidatorDoctrineChoice(array('model' => 'Memberstate', 'required' => false)),
      'organisation_id' => new sfValidatorDoctrineChoice(array('model' => 'Organisation', 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('memberstate_organisation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MemberstateOrganisation';
  }

}
