<?php

/**
 * ClauseAddressee form base class.
 *
 * @package    form
 * @subpackage clause_addressee
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseClauseAddresseeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'clause_id'    => new sfWidgetFormInputHidden(),
      'addressee_id' => new sfWidgetFormInputHidden(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'clause_id'    => new sfValidatorDoctrineChoice(array('model' => 'ClauseAddressee', 'column' => 'clause_id', 'required' => false)),
      'addressee_id' => new sfValidatorDoctrineChoice(array('model' => 'ClauseAddressee', 'column' => 'addressee_id', 'required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clause_addressee[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClauseAddressee';
  }

}
