<?php

/**
 * DocumentDocumentRelation filter form base class.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDocumentDocumentRelationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'                => new sfWidgetFormChoice(array('choices' => array('' => '', 'followup' => 'followup', 'recalls' => 'recalls', 'closely_related' => 'closely_related'))),
      'document_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => true)),
      'related_document_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentRelated'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'version'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'type'                => new sfValidatorChoice(array('required' => false, 'choices' => array('followup' => 'followup', 'recalls' => 'recalls', 'closely_related' => 'closely_related'))),
      'document_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Document'), 'column' => 'id')),
      'related_document_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DocumentRelated'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'version'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('document_document_relation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentDocumentRelation';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'type'                => 'Enum',
      'document_id'         => 'ForeignKey',
      'related_document_id' => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'created_by'          => 'Number',
      'version'             => 'Number',
    );
  }
}
