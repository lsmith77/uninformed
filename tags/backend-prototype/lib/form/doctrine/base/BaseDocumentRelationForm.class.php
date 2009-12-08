<?php

/**
 * DocumentRelation form base class.
 *
 * @package    form
 * @subpackage document_relation
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseDocumentRelationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'relation_type'       => new sfWidgetFormChoice(array('choices' => array('followup' => 'followup', 'recalls' => 'recalls', 'report' => 'report'))),
      'document_left_hand'  => new sfWidgetFormInput(),
      'document_right_hand' => new sfWidgetFormDoctrineChoice(array('model' => 'Document', 'add_empty' => false)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => 'DocumentRelation', 'column' => 'id', 'required' => false)),
      'relation_type'       => new sfValidatorChoice(array('choices' => array('followup' => 'followup', 'recalls' => 'recalls', 'report' => 'report'))),
      'document_left_hand'  => new sfValidatorInteger(),
      'document_right_hand' => new sfValidatorDoctrineChoice(array('model' => 'Document')),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document_relation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentRelation';
  }

}
