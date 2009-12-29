<?php

/**
 * DocumentDocumentRelationVersion form base class.
 *
 * @method DocumentDocumentRelationVersion getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDocumentDocumentRelationVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'type'                => new sfWidgetFormChoice(array('choices' => array('followup' => 'followup', 'recalls' => 'recalls', 'closely_related' => 'closely_related'))),
      'document_id'         => new sfWidgetFormInputText(),
      'related_document_id' => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'created_by'          => new sfWidgetFormInputText(),
      'version'             => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'type'                => new sfValidatorChoice(array('choices' => array('followup' => 'followup', 'recalls' => 'recalls', 'closely_related' => 'closely_related'))),
      'document_id'         => new sfValidatorInteger(),
      'related_document_id' => new sfValidatorInteger(),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'created_by'          => new sfValidatorInteger(),
      'version'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'version', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document_document_relation_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentDocumentRelationVersion';
  }

}
