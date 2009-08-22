<?php

/**
 * Memberstates form base class.
 *
 * @package    form
 * @subpackage memberstates
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMemberstatesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'memberstate_id' => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'memberstate_id' => new sfValidatorDoctrineChoice(array('model' => 'Memberstates', 'column' => 'memberstate_id', 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 45)),
    ));

    $this->widgetSchema->setNameFormat('memberstates[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Memberstates';
  }

}
