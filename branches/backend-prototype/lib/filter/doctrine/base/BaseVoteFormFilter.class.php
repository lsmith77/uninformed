<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Vote filter form base class.
 *
 * @package    filters
 * @subpackage Vote *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseVoteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'label'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'))),
      'document_id'    => new sfWidgetFormDoctrineChoice(array('model' => 'Document', 'add_empty' => true)),
      'memberstate_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Memberstate', 'add_empty' => true)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'label'          => new sfValidatorChoice(array('required' => false, 'choices' => array('signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'))),
      'document_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Document', 'column' => 'document_id')),
      'memberstate_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Memberstate', 'column' => 'memberstate_id')),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('vote_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vote';
  }

  public function getFields()
  {
    return array(
      'vote_id'        => 'Number',
      'label'          => 'Enum',
      'document_id'    => 'ForeignKey',
      'memberstate_id' => 'ForeignKey',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}