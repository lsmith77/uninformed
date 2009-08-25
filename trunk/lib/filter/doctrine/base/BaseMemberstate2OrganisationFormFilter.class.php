<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Memberstate2Organisation filter form base class.
 *
 * @package    filters
 * @subpackage Memberstate2Organisation *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseMemberstate2OrganisationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'memberstate_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Memberstate', 'add_empty' => true)),
      'organsation_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Organisation', 'add_empty' => true)),
      'from_date'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'to_date'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'memberstate_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Memberstate', 'column' => 'memberstate_id')),
      'organsation_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Organisation', 'column' => 'organisation_id')),
      'from_date'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'to_date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('memberstate2_organisation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Memberstate2Organisation';
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