<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Clauses filter form base class.
 *
 * @package    filters
 * @subpackage Clauses *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseClausesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(),
      'document_id'      => new sfWidgetFormDoctrineChoice(array('model' => 'Documents', 'add_empty' => true)),
      'clause_number'    => new sfWidgetFormFilterInput(),
      'parent_clause_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Clauses', 'add_empty' => true)),
      'information_type' => new sfWidgetFormFilterInput(),
      'operative_phrase' => new sfWidgetFormFilterInput(),
      'adressee'         => new sfWidgetFormFilterInput(),
      'relevance'        => new sfWidgetFormFilterInput(),
      'significants'     => new sfWidgetFormFilterInput(),
      'content'          => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'document_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Documents', 'column' => 'document_id')),
      'clause_number'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'parent_clause_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Clauses', 'column' => 'clause_id')),
      'information_type' => new sfValidatorPass(array('required' => false)),
      'operative_phrase' => new sfValidatorPass(array('required' => false)),
      'adressee'         => new sfValidatorPass(array('required' => false)),
      'relevance'        => new sfValidatorPass(array('required' => false)),
      'significants'     => new sfValidatorPass(array('required' => false)),
      'content'          => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('clauses_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Clauses';
  }

  public function getFields()
  {
    return array(
      'clause_id'        => 'Number',
      'name'             => 'Text',
      'document_id'      => 'ForeignKey',
      'clause_number'    => 'Number',
      'parent_clause_id' => 'ForeignKey',
      'information_type' => 'Text',
      'operative_phrase' => 'Text',
      'adressee'         => 'Text',
      'relevance'        => 'Text',
      'significants'     => 'Text',
      'content'          => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}