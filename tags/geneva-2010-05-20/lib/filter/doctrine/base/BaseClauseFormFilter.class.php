<?php

/**
 * Clause filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseClauseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => true)),
      'clause_body_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseBody'), 'add_empty' => true)),
      'clause_number'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'clause_number_information'  => new sfWidgetFormFilterInput(),
      'clause_number_subparagraph' => new sfWidgetFormFilterInput(),
      'private_comment'            => new sfWidgetFormFilterInput(),
      'slug'                       => new sfWidgetFormFilterInput(),
      'created_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'author_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'document_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Document'), 'column' => 'id')),
      'clause_body_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ClauseBody'), 'column' => 'id')),
      'clause_number'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'clause_number_information'  => new sfValidatorPass(array('required' => false)),
      'clause_number_subparagraph' => new sfValidatorPass(array('required' => false)),
      'private_comment'            => new sfValidatorPass(array('required' => false)),
      'slug'                       => new sfValidatorPass(array('required' => false)),
      'created_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'author_id'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Author'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('clause_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Clause';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'document_id'                => 'ForeignKey',
      'clause_body_id'             => 'ForeignKey',
      'clause_number'              => 'Number',
      'clause_number_information'  => 'Text',
      'clause_number_subparagraph' => 'Text',
      'private_comment'            => 'Text',
      'slug'                       => 'Text',
      'created_at'                 => 'Date',
      'updated_at'                 => 'Date',
      'author_id'                  => 'ForeignKey',
    );
  }
}
