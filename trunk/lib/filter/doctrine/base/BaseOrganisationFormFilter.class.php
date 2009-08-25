<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Organisation filter form base class.
 *
 * @package    filters
 * @subpackage Organisation *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseOrganisationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(),
      'parent_organisation_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Organisation', 'add_empty' => true)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'memberstates_list'      => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Memberstate')),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'parent_organisation_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Organisation', 'column' => 'organisation_id')),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'memberstates_list'      => new sfValidatorDoctrineChoiceMany(array('model' => 'Memberstate', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('organisation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addMemberstatesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.MemberstateOrganisation MemberstateOrganisation')
          ->andWhereIn('MemberstateOrganisation.memberstate_id', $values);
  }

  public function getModelName()
  {
    return 'Organisation';
  }

  public function getFields()
  {
    return array(
      'organisation_id'        => 'Number',
      'name'                   => 'Text',
      'parent_organisation_id' => 'ForeignKey',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'memberstates_list'      => 'ManyKey',
    );
  }
}