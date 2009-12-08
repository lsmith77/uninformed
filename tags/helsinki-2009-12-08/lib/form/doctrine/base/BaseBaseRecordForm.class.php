<?php

/**
 * BaseRecord form base class.
 *
 * @package    form
 * @subpackage base_record
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseBaseRecordForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id' => new sfValidatorDoctrineChoice(array('model' => 'BaseRecord', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('base_record[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BaseRecord';
  }

}
