<?php

/**
 * ExcelFile form base class.
 *
 * @package    form
 * @subpackage excel_file
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseExcelFileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInput(),
      'tag_id'      => new sfWidgetFormDoctrineChoice(array('model' => 'Tag', 'add_empty' => false)),
      'author'      => new sfWidgetFormInput(),
      'file'        => new sfWidgetFormInput(),
      'import_id'   => new sfWidgetFormDoctrineChoice(array('model' => 'Import', 'add_empty' => true)),
      'is_imported' => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => 'ExcelFile', 'column' => 'id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'tag_id'      => new sfValidatorDoctrineChoice(array('model' => 'Tag')),
      'author'      => new sfValidatorString(array('max_length' => 255)),
      'file'        => new sfValidatorString(array('max_length' => 255)),
      'import_id'   => new sfValidatorDoctrineChoice(array('model' => 'Import', 'required' => false)),
      'is_imported' => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('excel_file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExcelFile';
  }

}
