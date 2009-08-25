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
      'memberstate_id'     => new sfWidgetFormInputHidden(),
      'name'               => new sfWidgetFormInput(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'organisations_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Organisation')),
    ));

    $this->setValidators(array(
      'memberstate_id'     => new sfValidatorDoctrineChoice(array('model' => 'Memberstate', 'column' => 'memberstate_id', 'required' => false)),
      'name'               => new sfValidatorString(array('max_length' => 45)),
      'created_at'         => new sfValidatorDateTime(array('required' => false)),
      'updated_at'         => new sfValidatorDateTime(array('required' => false)),
      'organisations_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Organisation', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('memberstate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Memberstate';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['organisations_list']))
    {
      $this->setDefault('organisations_list', $this->object->Organisations->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveOrganisationsList($con);
  }

  public function saveOrganisationsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['organisations_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Organisations->getPrimaryKeys();
    $values = $this->getValue('organisations_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Organisations', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Organisations', array_values($link));
    }
  }

}
