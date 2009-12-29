<?php

/**
 * Import filter form base class.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseImportFormFilter extends sfGuardUserFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['created_by'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['created_by'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['version'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['version'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema->setNameFormat('import_filters[%s]');
  }

  public function getModelName()
  {
    return 'Import';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'created_by' => 'Number',
      'version' => 'Number',
    ));
  }
}
