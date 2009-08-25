<?php

/**
 * Memberstate2Organisation form base class.
 *
 * @package    form
 * @subpackage memberstate2_organisation
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMemberstate2OrganisationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'memberstate_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Memberstate', 'add_empty' => false)),
      'organsation_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Organisation', 'add_empty' => false)),
      'from_date'      => new sfWidgetFormDate(),
      'to_date'        => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => 'Memberstate2Organisation', 'column' => 'id', 'required' => false)),
      'memberstate_id' => new sfValidatorDoctrineChoice(array('model' => 'Memberstate')),
      'organsation_id' => new sfValidatorDoctrineChoice(array('model' => 'Organisation')),
      'from_date'      => new sfValidatorDate(array('required' => false)),
      'to_date'        => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('memberstate2_organisation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Memberstate2Organisation';
  }

}
