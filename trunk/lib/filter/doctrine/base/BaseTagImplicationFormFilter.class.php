<?php

/**
 * TagImplication filter form base class.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTagImplicationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'implication_type' => new sfWidgetFormChoice(array('choices' => array('' => '', 'implies' => 'implies', 'suggests' => 'suggests'))),
      'tag_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tag'), 'add_empty' => true)),
      'implied_tag_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ImpliedTag'), 'add_empty' => true)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'author_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'version'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'implication_type' => new sfValidatorChoice(array('required' => false, 'choices' => array('implies' => 'implies', 'suggests' => 'suggests'))),
      'tag_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tag'), 'column' => 'id')),
      'implied_tag_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ImpliedTag'), 'column' => 'id')),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'author_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Author'), 'column' => 'id')),
      'version'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('tag_implication_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagImplication';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'implication_type' => 'Enum',
      'tag_id'           => 'ForeignKey',
      'implied_tag_id'   => 'ForeignKey',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'author_id'        => 'ForeignKey',
      'version'          => 'Number',
    );
  }
}
