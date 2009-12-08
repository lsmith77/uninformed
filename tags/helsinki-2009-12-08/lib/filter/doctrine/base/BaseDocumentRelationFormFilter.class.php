<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * DocumentRelation filter form base class.
 *
 * @package    filters
 * @subpackage DocumentRelation *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseDocumentRelationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'relation_type'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'followup' => 'followup', 'recalls' => 'recalls', 'report' => 'report'))),
      'document_left_hand'  => new sfWidgetFormFilterInput(),
      'document_right_hand' => new sfWidgetFormDoctrineChoice(array('model' => 'Document', 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'relation_type'       => new sfValidatorChoice(array('required' => false, 'choices' => array('followup' => 'followup', 'recalls' => 'recalls', 'report' => 'report'))),
      'document_left_hand'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'document_right_hand' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Document', 'column' => 'document_id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('document_relation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentRelation';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'relation_type'       => 'Enum',
      'document_left_hand'  => 'Number',
      'document_right_hand' => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}