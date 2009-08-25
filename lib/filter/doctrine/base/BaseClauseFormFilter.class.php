<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Clause filter form base class.
 *
 * @package    filters
 * @subpackage Clause *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseClauseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(),
      'document_id'      => new sfWidgetFormDoctrineChoice(array('model' => 'Document', 'add_empty' => true)),
      'clause_number'    => new sfWidgetFormFilterInput(),
      'parent_clause_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Clause', 'add_empty' => true)),
      'information_type' => new sfWidgetFormFilterInput(),
      'operative_phrase' => new sfWidgetFormFilterInput(),
      'adressee'         => new sfWidgetFormFilterInput(),
      'relevance'        => new sfWidgetFormFilterInput(),
      'significants'     => new sfWidgetFormFilterInput(),
      'content'          => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'tags_list'        => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Tag')),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'document_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Document', 'column' => 'document_id')),
      'clause_number'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'parent_clause_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Clause', 'column' => 'clause_id')),
      'information_type' => new sfValidatorPass(array('required' => false)),
      'operative_phrase' => new sfValidatorPass(array('required' => false)),
      'adressee'         => new sfValidatorPass(array('required' => false)),
      'relevance'        => new sfValidatorPass(array('required' => false)),
      'significants'     => new sfValidatorPass(array('required' => false)),
      'content'          => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'tags_list'        => new sfValidatorDoctrineChoiceMany(array('model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clause_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addTagsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.ClauseTag ClauseTag')
          ->andWhereIn('ClauseTag.tag_id', $values);
  }

  public function getModelName()
  {
    return 'Clause';
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
      'tags_list'        => 'ManyKey',
    );
  }
}