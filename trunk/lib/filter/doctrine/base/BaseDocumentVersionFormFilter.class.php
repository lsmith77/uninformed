<?php

/**
 * DocumentVersion filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDocumentVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'                   => new sfWidgetFormFilterInput(),
      'enforcement_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'adoption_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'code'                   => new sfWidgetFormFilterInput(),
      'min_ratification_count' => new sfWidgetFormFilterInput(),
      'is_ratified'            => new sfWidgetFormFilterInput(),
      'vote_url'               => new sfWidgetFormFilterInput(),
      'private_comment'        => new sfWidgetFormFilterInput(),
      'public_comment'         => new sfWidgetFormFilterInput(),
      'parent_document_id'     => new sfWidgetFormFilterInput(),
      'organisation_id'        => new sfWidgetFormFilterInput(),
      'documenttype_id'        => new sfWidgetFormFilterInput(),
      'document_url'           => new sfWidgetFormFilterInput(),
      'clause_ordering'        => new sfWidgetFormFilterInput(),
      'status'                 => new sfWidgetFormChoice(array('choices' => array('' => '', 'draft' => 'draft', 'review' => 'review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'author_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'slug'                   => new sfValidatorPass(array('required' => false)),
      'enforcement_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'adoption_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'code'                   => new sfValidatorPass(array('required' => false)),
      'min_ratification_count' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_ratified'            => new sfValidatorPass(array('required' => false)),
      'vote_url'               => new sfValidatorPass(array('required' => false)),
      'private_comment'        => new sfValidatorPass(array('required' => false)),
      'public_comment'         => new sfValidatorPass(array('required' => false)),
      'parent_document_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'organisation_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'documenttype_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'document_url'           => new sfValidatorPass(array('required' => false)),
      'clause_ordering'        => new sfValidatorPass(array('required' => false)),
      'status'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('draft' => 'draft', 'review' => 'review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'author_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Author'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('document_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentVersion';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'name'                   => 'Text',
      'slug'                   => 'Text',
      'enforcement_date'       => 'Date',
      'adoption_date'          => 'Date',
      'code'                   => 'Text',
      'min_ratification_count' => 'Number',
      'is_ratified'            => 'Text',
      'vote_url'               => 'Text',
      'private_comment'        => 'Text',
      'public_comment'         => 'Text',
      'parent_document_id'     => 'Number',
      'organisation_id'        => 'Number',
      'documenttype_id'        => 'Number',
      'document_url'           => 'Text',
      'clause_ordering'        => 'Text',
      'status'                 => 'Enum',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'author_id'              => 'ForeignKey',
      'version'                => 'Number',
    );
  }
}
