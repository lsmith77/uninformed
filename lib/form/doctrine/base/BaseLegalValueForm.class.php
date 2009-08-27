<?php

/**
 * LegalValue form base class.
 *
 * @package    form
 * @subpackage legal_value
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseLegalValueForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'legal_value_id' => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'legal_value_id' => new sfValidatorDoctrineChoice(array('model' => 'LegalValue', 'column' => 'legal_value_id', 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 45)),
    ));

    $this->widgetSchema->setNameFormat('legal_value[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LegalValue';
  }

}
