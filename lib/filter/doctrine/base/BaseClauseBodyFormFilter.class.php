<?php

/**
 * ClauseBody filter form base class.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseClauseBodyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'content'               => new sfWidgetFormFilterInput(),
      'information_type_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseInformationType'), 'add_empty' => true)),
      'operative_phrase_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseOperativePhrase'), 'add_empty' => true)),
      'clause_process_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseProcess'), 'add_empty' => true)),
      'public_comment'        => new sfWidgetFormFilterInput(),
      'parent_clause_body_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseBodyParent'), 'add_empty' => true)),
      'status'                => new sfWidgetFormChoice(array('choices' => array('' => '', 'draft' => 'draft', 'in_review' => 'in_review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'version'               => new sfWidgetFormFilterInput(),
      'tags_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tag')),
      'addressee_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Addressee')),
      'tag_list'              => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tag')),
    ));

    $this->setValidators(array(
      'content'               => new sfValidatorPass(array('required' => false)),
      'information_type_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ClauseInformationType'), 'column' => 'id')),
      'operative_phrase_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ClauseOperativePhrase'), 'column' => 'id')),
      'clause_process_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ClauseProcess'), 'column' => 'id')),
      'public_comment'        => new sfValidatorPass(array('required' => false)),
      'parent_clause_body_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ClauseBodyParent'), 'column' => 'id')),
      'status'                => new sfValidatorChoice(array('required' => false, 'choices' => array('draft' => 'draft', 'in_review' => 'in_review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'version'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tags_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
      'addressee_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Addressee', 'required' => false)),
      'tag_list'              => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clause_body_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
          ->andWhereIn('ClauseTag.id', $values);
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

  public function addTagListColumnQuery(Doctrine_Query $query, $field, $values)
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
    return 'ClauseBody';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'content'               => 'Text',
      'information_type_id'   => 'ForeignKey',
      'operative_phrase_id'   => 'ForeignKey',
      'clause_process_id'     => 'ForeignKey',
      'public_comment'        => 'Text',
      'parent_clause_body_id' => 'ForeignKey',
      'status'                => 'Enum',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'created_by'            => 'Number',
      'version'               => 'Number',
      'tags_list'             => 'ManyKey',
      'addressee_list'        => 'ManyKey',
      'tag_list'              => 'ManyKey',
    );
  }
}
