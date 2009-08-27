<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * MemberstateOrganisation filter form base class.
 *
 * @package    filters
 * @subpackage MemberstateOrganisation *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseMemberstateOrganisationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('memberstate_organisation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MemberstateOrganisation';
  }

  public function getFields()
  {
    return array(
      'memberstate_id'  => 'Number',
      'organisation_id' => 'Number',
      'month'           => 'Date',
    );
  }
}