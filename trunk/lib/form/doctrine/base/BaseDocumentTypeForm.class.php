<?php

/**
 * DocumentType form base class.
 *
 * @package    form
 * @subpackage document_type
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseDocumentTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'documenttype_id' => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInput(),
      'legalvalue_id'   => new sfWidgetFormDoctrineChoice(array('model' => 'LegalValue', 'add_empty' => true)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'documenttype_id' => new sfValidatorDoctrineChoice(array('model' => 'DocumentType', 'column' => 'documenttype_id', 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 255)),
      'legalvalue_id'   => new sfValidatorDoctrineChoice(array('model' => 'LegalValue', 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentType';
  }

}
