<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Memberstate filter form base class.
 *
 * @package    filters
 * @subpackage Memberstate *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseMemberstateFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'               => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'organisations_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Organisation')),
    ));

    $this->setValidators(array(
      'name'               => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'organisations_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Organisation', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('memberstate_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addOrganisationsListColumnQuery(Doctrine_Query $query, $field, $values)
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
          ->andWhereIn('MemberstateOrganisation.organisation_id', $values);
  }

  public function getModelName()
  {
    return 'Memberstate';
  }

  public function getFields()
  {
    return array(
      'memberstate_id'     => 'Number',
      'name'               => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'organisations_list' => 'ManyKey',
    );
  }
}