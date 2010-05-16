<?php

/**
 * ClauseBody filter form base class.
 *
 * @package    symfony
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
      'public_comment'        => new sfWidgetFormFilterInput(),
      'parent_clause_body_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseBodyParent'), 'add_empty' => true)),
      'root_clause_body_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseBodyRoot'), 'add_empty' => true)),
      'is_latest_clause_body' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'status'                => new sfWidgetFormChoice(array('choices' => array('' => '', 'draft' => 'draft', 'review' => 'review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'author_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'addressees_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Addressee')),
      'tags_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tag')),
    ));

    $this->setValidators(array(
      'content'               => new sfValidatorPass(array('required' => false)),
      'information_type_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ClauseInformationType'), 'column' => 'id')),
      'operative_phrase_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ClauseOperativePhrase'), 'column' => 'id')),
      'public_comment'        => new sfValidatorPass(array('required' => false)),
      'parent_clause_body_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ClauseBodyParent'), 'column' => 'id')),
      'root_clause_body_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ClauseBodyRoot'), 'column' => 'id')),
      'is_latest_clause_body' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'status'                => new sfValidatorChoice(array('required' => false, 'choices' => array('draft' => 'draft', 'review' => 'review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'author_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Author'), 'column' => 'id')),
      'addressees_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Addressee', 'required' => false)),
      'tags_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clause_body_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addAddresseesListColumnQuery(Doctrine_Query $query, $field, $values)
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
          ->andWhereIn('ClauseAddressee.addressee_id', $values);
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

    $query->leftJoin('r.ClauseBodyTag ClauseBodyTag')
          ->andWhereIn('ClauseBodyTag.tag_id', $values);
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
      'public_comment'        => 'Text',
      'parent_clause_body_id' => 'ForeignKey',
      'root_clause_body_id'   => 'ForeignKey',
      'is_latest_clause_body' => 'Boolean',
      'status'                => 'Enum',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'author_id'             => 'ForeignKey',
      'addressees_list'       => 'ManyKey',
      'tags_list'             => 'ManyKey',
    );
  }
}
