<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ExcelFile filter form base class.
 *
 * @package    filters
 * @subpackage ExcelFile *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseExcelFileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(),
      'tag_id'      => new sfWidgetFormDoctrineChoice(array('model' => 'Tag', 'add_empty' => true)),
      'author'      => new sfWidgetFormFilterInput(),
      'file'        => new sfWidgetFormFilterInput(),
      'import_id'   => new sfWidgetFormDoctrineChoice(array('model' => 'Import', 'add_empty' => true)),
      'is_imported' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'tag_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Tag', 'column' => 'tag_id')),
      'author'      => new sfValidatorPass(array('required' => false)),
      'file'        => new sfValidatorPass(array('required' => false)),
      'import_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Import', 'column' => 'id')),
      'is_imported' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('excel_file_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExcelFile';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'tag_id'      => 'ForeignKey',
      'author'      => 'Text',
      'file'        => 'Text',
      'import_id'   => 'ForeignKey',
      'is_imported' => 'Boolean',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}