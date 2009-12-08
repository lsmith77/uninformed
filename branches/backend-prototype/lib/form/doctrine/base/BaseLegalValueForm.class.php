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
      'legalvalue_id' => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInput(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'legalvalue_id' => new sfValidatorDoctrineChoice(array('model' => 'LegalValue', 'column' => 'legalvalue_id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 255)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
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
