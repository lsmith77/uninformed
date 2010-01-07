<?php

/**
 * ExcelFileVersion form base class.
 *
 * @method ExcelFileVersion getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseExcelFileVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
      'tag_id'          => new sfWidgetFormInputText(),
      'file'            => new sfWidgetFormInputText(),
      'excel_author_id' => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'author_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'version'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 255)),
      'tag_id'          => new sfValidatorInteger(),
      'file'            => new sfValidatorString(array('max_length' => 255)),
      'excel_author_id' => new sfValidatorInteger(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'author_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'version'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'version', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('excel_file_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExcelFileVersion';
  }

}
