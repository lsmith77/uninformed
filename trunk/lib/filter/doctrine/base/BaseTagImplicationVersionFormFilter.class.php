<?php

/**
 * TagImplicationVersion filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTagImplicationVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'implication_type' => new sfWidgetFormChoice(array('choices' => array('' => '', 'implies' => 'implies', 'suggests' => 'suggests'))),
      'tag_id'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'implied_tag_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'author_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'implication_type' => new sfValidatorChoice(array('required' => false, 'choices' => array('implies' => 'implies', 'suggests' => 'suggests'))),
      'tag_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'implied_tag_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'author_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Author'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tag_implication_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagImplicationVersion';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'implication_type' => 'Enum',
      'tag_id'           => 'Number',
      'implied_tag_id'   => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'author_id'        => 'ForeignKey',
      'version'          => 'Number',
    );
  }
}
