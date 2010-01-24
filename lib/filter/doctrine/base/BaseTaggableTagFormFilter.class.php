<?php

/**
 * TaggableTag filter form base class.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTaggableTagFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(),
      'clause_body_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ClauseBody')),
      'document_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Document')),
      'excel_file_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ExcelFile')),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'clause_body_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ClauseBody', 'required' => false)),
      'document_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Document', 'required' => false)),
      'excel_file_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ExcelFile', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('taggable_tag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addClauseBodyListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.ClauseBodyTaggableTag ClauseBodyTaggableTag')
          ->andWhereIn('ClauseBodyTaggableTag.id', $values);
  }

  public function addDocumentListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.DocumentTaggableTag DocumentTaggableTag')
          ->andWhereIn('DocumentTaggableTag.id', $values);
  }

  public function addExcelFileListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.ExcelFileTaggableTag ExcelFileTaggableTag')
          ->andWhereIn('ExcelFileTaggableTag.id', $values);
  }

  public function getModelName()
  {
    return 'TaggableTag';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'clause_body_list' => 'ManyKey',
      'document_list'    => 'ManyKey',
      'excel_file_list'  => 'ManyKey',
    );
  }
}
