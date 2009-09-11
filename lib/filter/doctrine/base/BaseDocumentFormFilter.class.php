<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Document filter form base class.
 *
 * @package    filters
 * @subpackage Document *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseDocumentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(),
      'publication_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'adoption_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'code'                   => new sfWidgetFormFilterInput(),
      'min_ratification_count' => new sfWidgetFormFilterInput(),
      'preamble'               => new sfWidgetFormFilterInput(),
      'parent_id'              => new sfWidgetFormDoctrineChoice(array('model' => 'Document', 'add_empty' => true)),
      'organisation_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'Organisation', 'add_empty' => true)),
      'documenttype_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'DocumentType', 'add_empty' => true)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'tags_list'              => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Tag')),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'publication_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'adoption_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'code'                   => new sfValidatorPass(array('required' => false)),
      'min_ratification_count' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'preamble'               => new sfValidatorPass(array('required' => false)),
      'parent_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Document', 'column' => 'document_id')),
      'organisation_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Organisation', 'column' => 'organisation_id')),
      'documenttype_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'DocumentType', 'column' => 'documenttype_id')),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'tags_list'              => new sfValidatorDoctrineChoiceMany(array('model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document_filters[%s]');

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

    $query->leftJoin('r.DocumentTag DocumentTag')
          ->andWhereIn('DocumentTag.tag_id', $values);
  }

  public function getModelName()
  {
    return 'Document';
  }

  public function getFields()
  {
    return array(
      'document_id'            => 'Number',
      'name'                   => 'Text',
      'publication_date'       => 'Date',
      'adoption_date'          => 'Date',
      'code'                   => 'Text',
      'min_ratification_count' => 'Number',
      'preamble'               => 'Text',
      'parent_id'              => 'ForeignKey',
      'organisation_id'        => 'ForeignKey',
      'documenttype_id'        => 'ForeignKey',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'tags_list'              => 'ManyKey',
    );
  }
}