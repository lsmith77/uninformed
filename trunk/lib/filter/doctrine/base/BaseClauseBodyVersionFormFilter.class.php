<?php

/**
 * ClauseBodyVersion filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseClauseBodyVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'content'               => new sfWidgetFormFilterInput(),
      'information_type_id'   => new sfWidgetFormFilterInput(),
      'operative_phrase_id'   => new sfWidgetFormFilterInput(),
      'clause_process_id'     => new sfWidgetFormFilterInput(),
      'public_comment'        => new sfWidgetFormFilterInput(),
      'parent_clause_body_id' => new sfWidgetFormFilterInput(),
      'status'                => new sfWidgetFormChoice(array('choices' => array('' => '', 'draft' => 'draft', 'review' => 'review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'author_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'content'               => new sfValidatorPass(array('required' => false)),
      'information_type_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'operative_phrase_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'clause_process_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'public_comment'        => new sfValidatorPass(array('required' => false)),
      'parent_clause_body_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                => new sfValidatorChoice(array('required' => false, 'choices' => array('draft' => 'draft', 'review' => 'review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'author_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Author'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('clause_body_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClauseBodyVersion';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'content'               => 'Text',
      'information_type_id'   => 'Number',
      'operative_phrase_id'   => 'Number',
      'clause_process_id'     => 'Number',
      'public_comment'        => 'Text',
      'parent_clause_body_id' => 'Number',
      'status'                => 'Enum',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'author_id'             => 'ForeignKey',
      'version'               => 'Number',
    );
  }
}
