<?php

/**
 * Import form base class.
 *
 * @method Import getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseImportForm extends sfGuardUserForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['version'] = new sfWidgetFormInputText();
    $this->validatorSchema['version'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema->setNameFormat('import[%s]');
  }

  public function getModelName()
  {
    return 'Import';
  }

}
