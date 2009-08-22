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
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'parent_organisation_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Organisations', 'column' => 'organisation_id')),
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
    );
  }
}