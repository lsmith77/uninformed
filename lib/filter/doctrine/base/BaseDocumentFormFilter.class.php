<?php

/**
 * Document filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'                   => new sfWidgetFormFilterInput(),
      'enforcement_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'adoption_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'code'                   => new sfWidgetFormFilterInput(),
      'min_ratification_count' => new sfWidgetFormFilterInput(),
      'is_ratified'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'vote_url'               => new sfWidgetFormFilterInput(),
      'private_comment'        => new sfWidgetFormFilterInput(),
      'public_comment'         => new sfWidgetFormFilterInput(),
      'parent_document_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentParent'), 'add_empty' => true)),
      'root_document_id'       => new sfWidgetFormFilterInput(),
      'organisation_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organisation'), 'add_empty' => true)),
      'documenttype_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'add_empty' => true)),
      'document_url'           => new sfWidgetFormFilterInput(),
      'status'                 => new sfWidgetFormChoice(array('choices' => array('' => '', 'draft' => 'draft', 'review' => 'review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'author_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'tags_list'              => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tag')),
    ));

    $this->setValidators(array(
      'title'                  => new sfValidatorPass(array('required' => false)),
      'slug'                   => new sfValidatorPass(array('required' => false)),
      'enforcement_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'adoption_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'code'                   => new sfValidatorPass(array('required' => false)),
      'min_ratification_count' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_ratified'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'vote_url'               => new sfValidatorPass(array('required' => false)),
      'private_comment'        => new sfValidatorPass(array('required' => false)),
      'public_comment'         => new sfValidatorPass(array('required' => false)),
      'parent_document_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DocumentParent'), 'column' => 'id')),
      'root_document_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'organisation_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organisation'), 'column' => 'id')),
      'documenttype_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DocumentType'), 'column' => 'id')),
      'document_url'           => new sfValidatorPass(array('required' => false)),
      'status'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('draft' => 'draft', 'review' => 'review', 'reviewed' => 'reviewed', 'inactive' => 'inactive', 'active' => 'active'))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'author_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Author'), 'column' => 'id')),
      'tags_list'              => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document_filters[%s]');

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

    $query
      ->leftJoin($query->getRootAlias().'.DocumentTag DocumentTag')
      ->andWhereIn('DocumentTag.tag_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Document';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'title'                  => 'Text',
      'slug'                   => 'Text',
      'enforcement_date'       => 'Date',
      'adoption_date'          => 'Date',
      'code'                   => 'Text',
      'min_ratification_count' => 'Number',
      'is_ratified'            => 'Boolean',
      'vote_url'               => 'Text',
      'private_comment'        => 'Text',
      'public_comment'         => 'Text',
      'parent_document_id'     => 'ForeignKey',
      'root_document_id'       => 'Number',
      'organisation_id'        => 'ForeignKey',
      'documenttype_id'        => 'ForeignKey',
      'document_url'           => 'Text',
      'status'                 => 'Enum',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'author_id'              => 'ForeignKey',
      'tags_list'              => 'ManyKey',
    );
  }
}
