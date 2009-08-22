<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Documents filter form base class.
 *
 * @package    filters
 * @subpackage Documents *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseDocumentsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(),
      'date'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'documenttype_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'Documenttypes', 'add_empty' => true)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'legal_value'            => new sfWidgetFormFilterInput(),
      'organisation_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'Organisations', 'add_empty' => true)),
      'adoption_date'          => new sfWidgetFormFilterInput(),
      'code'                   => new sfWidgetFormFilterInput(),
      'min_ratification_count' => new sfWidgetFormFilterInput(),
      'preamble'               => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'date'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'documenttype_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Documenttypes', 'column' => 'documenttype_id')),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'legal_value'            => new sfValidatorPass(array('required' => false)),
      'organisation_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Organisations', 'column' => 'organisation_id')),
      'adoption_date'          => new sfValidatorPass(array('required' => false)),
      'code'                   => new sfValidatorPass(array('required' => false)),
      'min_ratification_count' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'preamble'               => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documents_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documents';
  }

  public function getFields()
  {
    return array(
      'document_id'            => 'Number',
      'name'                   => 'Text',
      'date'                   => 'Date',
      'documenttype_id'        => 'ForeignKey',
      'updated_at'             => 'Date',
      'created_at'             => 'Date',
      'legal_value'            => 'Text',
      'organisation_id'        => 'ForeignKey',
      'adoption_date'          => 'Text',
      'code'                   => 'Text',
      'min_ratification_count' => 'Number',
      'preamble'               => 'Text',
    );
  }
}