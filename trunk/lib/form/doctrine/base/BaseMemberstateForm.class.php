<?php

/**
 * Memberstate form base class.
 *
 * @package    form
 * @subpackage memberstate
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMemberstateForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'memberstate_id' => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInput(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'memberstate_id' => new sfValidatorDoctrineChoice(array('model' => 'Memberstate', 'column' => 'memberstate_id', 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('memberstate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Memberstate';
  }

}
