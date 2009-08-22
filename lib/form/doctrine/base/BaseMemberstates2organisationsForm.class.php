<?php

/**
 * Memberstates2organisations form base class.
 *
 * @package    form
 * @subpackage memberstates2organisations
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMemberstates2organisationsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'memberstate_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Memberstates', 'add_empty' => false)),
      'organsation_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Organisations', 'add_empty' => false)),
      'from_date'      => new sfWidgetFormDate(),
      'to_date'        => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => 'Memberstates2organisations', 'column' => 'id', 'required' => false)),
      'memberstate_id' => new sfValidatorDoctrineChoice(array('model' => 'Memberstates')),
      'organsation_id' => new sfValidatorDoctrineChoice(array('model' => 'Organisations')),
      'from_date'      => new sfValidatorDate(array('required' => false)),
      'to_date'        => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('memberstates2organisations[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Memberstates2organisations';
  }

}
