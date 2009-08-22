<?php

/**
 * Organisations form base class.
 *
 * @package    form
 * @subpackage organisations
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseOrganisationsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'organisation_id'        => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInput(),
      'parent_organisation_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Organisations', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'organisation_id'        => new sfValidatorDoctrineChoice(array('model' => 'Organisations', 'column' => 'organisation_id', 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 45)),
      'parent_organisation_id' => new sfValidatorDoctrineChoice(array('model' => 'Organisations', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('organisations[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organisations';
  }

}
