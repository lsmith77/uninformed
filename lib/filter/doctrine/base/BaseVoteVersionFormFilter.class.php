<?php

/**
 * VoteVersion filter form base class.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseVoteVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'))),
      'document_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'country_id'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'type'        => new sfValidatorChoice(array('required' => false, 'choices' => array('signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'))),
      'document_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'country_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('vote_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VoteVersion';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'type'        => 'Enum',
      'document_id' => 'Number',
      'country_id'  => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'created_by'  => 'Number',
      'version'     => 'Number',
    );
  }
}
