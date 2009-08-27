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
      'memberstate_id'  => new sfWidgetFormInputHidden(),
      'organisation_id' => new sfWidgetFormInputHidden(),
      'month'           => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'memberstate_id'  => new sfValidatorDoctrineChoice(array('model' => 'MemberstateOrganisation', 'column' => 'memberstate_id', 'required' => false)),
      'organisation_id' => new sfValidatorDoctrineChoice(array('model' => 'MemberstateOrganisation', 'column' => 'organisation_id', 'required' => false)),
      'month'           => new sfValidatorDoctrineChoice(array('model' => 'MemberstateOrganisation', 'column' => 'month', 'required' => false)),
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
