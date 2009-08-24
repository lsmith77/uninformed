<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Organisations filter form base class.
 *
 * @package    filters
 * @subpackage Organisations *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseOrganisationsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(),
      'parent_organisation_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Organisations', 'add_empty' => true)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'parent_organisation_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Organisations', 'column' => 'organisation_id')),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('organisations_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organisations';
  }

  public function getFields()
  {
    return array(
      'organisation_id'        => 'Number',
      'name'                   => 'Text',
      'parent_organisation_id' => 'ForeignKey',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}