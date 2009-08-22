<?php

/**
 * Documenttypes form base class.
 *
 * @package    form
 * @subpackage documenttypes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseDocumenttypesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'documenttype_id' => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInput(),
      'legal_value'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'documenttype_id' => new sfValidatorDoctrineChoice(array('model' => 'Documenttypes', 'column' => 'documenttype_id', 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 45)),
      'legal_value'     => new sfValidatorString(array('max_length' => 45)),
    ));

    $this->widgetSchema->setNameFormat('documenttypes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documenttypes';
  }

}
