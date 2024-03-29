<?php

/**
 * DocumentDocumentRelation form base class.
 *
 * @method DocumentDocumentRelation getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentDocumentRelationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'type'                => new sfWidgetFormChoice(array('choices' => array('recalls' => 'recalls', 'closely related' => 'closely related'))),
      'document_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => false)),
      'related_document_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentRelated'), 'add_empty' => false)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'author_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'type'                => new sfValidatorChoice(array('choices' => array(0 => 'recalls', 1 => 'closely related'))),
      'document_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Document'))),
      'related_document_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentRelated'))),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'author_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'DocumentDocumentRelation', 'column' => array('document_id', 'related_document_id', 'type')))
    );

    $this->widgetSchema->setNameFormat('document_document_relation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentDocumentRelation';
  }

}
