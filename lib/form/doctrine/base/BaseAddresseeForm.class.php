<?php

/**
 * Addressee form base class.
 *
 * @method Addressee getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAddresseeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'created_by'   => new sfWidgetFormInputText(),
      'version'      => new sfWidgetFormInputText(),
      'clauses_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ClauseBody')),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'created_by'   => new sfValidatorInteger(),
      'version'      => new sfValidatorInteger(array('required' => false)),
      'clauses_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ClauseBody', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('addressee[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Addressee';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['clauses_list']))
    {
      $this->setDefault('clauses_list', $this->object->Clauses->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveClausesList($con);

    parent::doSave($con);
  }

  public function saveClausesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['clauses_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Clauses->getPrimaryKeys();
    $values = $this->getValue('clauses_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Clauses', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Clauses', array_values($link));
    }
  }

}
