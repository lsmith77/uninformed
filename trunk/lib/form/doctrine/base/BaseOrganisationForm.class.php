<?php

/**
 * Organisation form base class.
 *
 * @package    form
 * @subpackage organisation
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseOrganisationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'organisation_id'        => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInput(),
      'parent_organisation_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Organisation', 'add_empty' => true)),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'memberstates_list'      => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Memberstate')),
    ));

    $this->setValidators(array(
      'organisation_id'        => new sfValidatorDoctrineChoice(array('model' => 'Organisation', 'column' => 'organisation_id', 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 45)),
      'parent_organisation_id' => new sfValidatorDoctrineChoice(array('model' => 'Organisation', 'required' => false)),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
      'memberstates_list'      => new sfValidatorDoctrineChoiceMany(array('model' => 'Memberstate', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('organisation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organisation';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['memberstates_list']))
    {
      $this->setDefault('memberstates_list', $this->object->Memberstates->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveMemberstatesList($con);
  }

  public function saveMemberstatesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['memberstates_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Memberstates->getPrimaryKeys();
    $values = $this->getValue('memberstates_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Memberstates', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Memberstates', array_values($link));
    }
  }

}
