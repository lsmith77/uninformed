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
      'clause_process'   => new sfWidgetFormDoctrineChoice(array('model' => 'ClauseProcess', 'add_empty' => true)),
      'clause_number'    => new sfWidgetFormFilterInput(),
      'information_type' => new sfWidgetFormDoctrineChoice(array('model' => 'ClauseInformationType', 'add_empty' => true)),
      'operative_phrase' => new sfWidgetFormDoctrineChoice(array('model' => 'ClauseOperativePhrase', 'add_empty' => true)),
      'relevance'        => new sfWidgetFormFilterInput(),
      'significants'     => new sfWidgetFormFilterInput(),
      'content'          => new sfWidgetFormFilterInput(),
      'parent_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'Clause', 'add_empty' => true)),
      'document_id'      => new sfWidgetFormDoctrineChoice(array('model' => 'Document', 'add_empty' => true)),
      'import_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'Import', 'add_empty' => true)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'tags_list'        => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Tag')),
      'addressee_list'   => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Addressee')),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'clause_process'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'ClauseProcess', 'column' => 'id')),
      'clause_number'    => new sfValidatorPass(array('required' => false)),
      'information_type' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'ClauseInformationType', 'column' => 'id')),
      'operative_phrase' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'ClauseOperativePhrase', 'column' => 'id')),
      'relevance'        => new sfValidatorPass(array('required' => false)),
      'significants'     => new sfValidatorPass(array('required' => false)),
      'content'          => new sfValidatorPass(array('required' => false)),
      'parent_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Clause', 'column' => 'clause_id')),
      'document_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Document', 'column' => 'document_id')),
      'import_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Import', 'column' => 'id')),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'tags_list'        => new sfValidatorDoctrineChoiceMany(array('model' => 'Tag', 'required' => false)),
      'addressee_list'   => new sfValidatorDoctrineChoiceMany(array('model' => 'Addressee', 'required' => false)),
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

  public function addAddresseeListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.ClauseAddressee ClauseAddressee')
          ->andWhereIn('ClauseAddressee.id', $values);
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
      'clause_process'   => 'ForeignKey',
      'clause_number'    => 'Text',
      'information_type' => 'ForeignKey',
      'operative_phrase' => 'ForeignKey',
      'relevance'        => 'Text',
      'significants'     => 'Text',
      'content'          => 'Text',
      'parent_id'        => 'ForeignKey',
      'document_id'      => 'ForeignKey',
      'import_id'        => 'ForeignKey',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'tags_list'        => 'ManyKey',
      'addressee_list'   => 'ManyKey',
    );
  }
}