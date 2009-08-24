<?php

/**
 * Documents form base class.
 *
 * @package    form
 * @subpackage documents
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseDocumentsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_id'            => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInput(),
      'publication_date'       => new sfWidgetFormDate(),
      'documenttype_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'Documenttypes', 'add_empty' => false)),
      'legal_value'            => new sfWidgetFormInput(),
      'organisation_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'Organisations', 'add_empty' => false)),
      'adoption_date'          => new sfWidgetFormDateTime(),
      'code'                   => new sfWidgetFormInput(),
      'min_ratification_count' => new sfWidgetFormInput(),
      'preamble'               => new sfWidgetFormTextarea(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'document_id'            => new sfValidatorDoctrineChoice(array('model' => 'Documents', 'column' => 'document_id', 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 45)),
      'publication_date'       => new sfValidatorDate(),
      'documenttype_id'        => new sfValidatorDoctrineChoice(array('model' => 'Documenttypes')),
      'legal_value'            => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'organisation_id'        => new sfValidatorDoctrineChoice(array('model' => 'Organisations')),
      'adoption_date'          => new sfValidatorDateTime(array('required' => false)),
      'code'                   => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'min_ratification_count' => new sfValidatorInteger(array('required' => false)),
      'preamble'               => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documents[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documents';
  }

}
