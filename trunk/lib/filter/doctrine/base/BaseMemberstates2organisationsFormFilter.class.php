<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Memberstates2organisations filter form base class.
 *
 * @package    filters
 * @subpackage Memberstates2organisations *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseMemberstates2organisationsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'memberstate_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Memberstates', 'add_empty' => true)),
      'organsation_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Organisations', 'add_empty' => true)),
      'from_date'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'to_date'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'memberstate_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Memberstates', 'column' => 'memberstate_id')),
      'organsation_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Organisations', 'column' => 'organisation_id')),
      'from_date'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'to_date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('memberstates2organisations_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Memberstates2organisations';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'memberstate_id' => 'ForeignKey',
      'organsation_id' => 'ForeignKey',
      'from_date'      => 'Date',
      'to_date'        => 'Date',
    );
  }
}