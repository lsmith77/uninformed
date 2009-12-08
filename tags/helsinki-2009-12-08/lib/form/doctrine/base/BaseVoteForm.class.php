<?php

/**
 * Vote form base class.
 *
 * @package    form
 * @subpackage vote
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseVoteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'vote_id'        => new sfWidgetFormInputHidden(),
      'label'          => new sfWidgetFormChoice(array('choices' => array('signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'))),
      'document_id'    => new sfWidgetFormDoctrineChoice(array('model' => 'Document', 'add_empty' => true)),
      'memberstate_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Memberstate', 'add_empty' => true)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'vote_id'        => new sfValidatorDoctrineChoice(array('model' => 'Vote', 'column' => 'vote_id', 'required' => false)),
      'label'          => new sfValidatorChoice(array('choices' => array('signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'), 'required' => false)),
      'document_id'    => new sfValidatorDoctrineChoice(array('model' => 'Document', 'required' => false)),
      'memberstate_id' => new sfValidatorDoctrineChoice(array('model' => 'Memberstate', 'required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('vote[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vote';
  }

}
