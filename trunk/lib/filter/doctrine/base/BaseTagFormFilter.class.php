<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Tag filter form base class.
 *
 * @package    filters
 * @subpackage Tag *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseTagFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                 => new sfWidgetFormFilterInput(),
      'tag_type'             => new sfWidgetFormChoice(array('choices' => array('' => '', 'legal_measure' => 'legal_measure'))),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'clauses_list'         => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Clause')),
      'documents_list'       => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Document')),
      'tag_hierarchies_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'TagHierarchie')),
    ));

    $this->setValidators(array(
      'name'                 => new sfValidatorPass(array('required' => false)),
      'tag_type'             => new sfValidatorChoice(array('required' => false, 'choices' => array('legal_measure' => 'legal_measure'))),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'clauses_list'         => new sfValidatorDoctrineChoiceMany(array('model' => 'Clause', 'required' => false)),
      'documents_list'       => new sfValidatorDoctrineChoiceMany(array('model' => 'Document', 'required' => false)),
      'tag_hierarchies_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'TagHierarchie', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addClausesListColumnQuery(Doctrine_Query $query, $field, $values)
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
          ->andWhereIn('ClauseTag.clause_id', $values);
  }

  public function addDocumentsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.DocumentTag DocumentTag')
          ->andWhereIn('DocumentTag.document_id', $values);
  }

  public function addTagHierarchiesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.TagHierarchieTag TagHierarchieTag')
          ->andWhereIn('TagHierarchieTag.taghierarchie_id', $values);
  }

  public function getModelName()
  {
    return 'Tag';
  }

  public function getFields()
  {
    return array(
      'tag_id'               => 'Number',
      'name'                 => 'Text',
      'tag_type'             => 'Enum',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
      'clauses_list'         => 'ManyKey',
      'documents_list'       => 'ManyKey',
      'tag_hierarchies_list' => 'ManyKey',
    );
  }
}