<?php

/**
 * ClauseVersion filter form base class.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseClauseVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_id'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'clause_body_id'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'clause_number'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'clause_number_information'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'clause_number_subparagraph' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'private_comment'            => new sfWidgetFormFilterInput(),
      'created_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'document_id'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'clause_body_id'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'clause_number'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'clause_number_information'  => new sfValidatorPass(array('required' => false)),
      'clause_number_subparagraph' => new sfValidatorPass(array('required' => false)),
      'private_comment'            => new sfValidatorPass(array('required' => false)),
      'created_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('clause_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClauseVersion';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'document_id'                => 'Number',
      'clause_body_id'             => 'Number',
      'clause_number'              => 'Number',
      'clause_number_information'  => 'Text',
      'clause_number_subparagraph' => 'Text',
      'private_comment'            => 'Text',
      'created_at'                 => 'Date',
      'updated_at'                 => 'Date',
      'created_by'                 => 'Number',
      'version'                    => 'Number',
    );
  }
}
