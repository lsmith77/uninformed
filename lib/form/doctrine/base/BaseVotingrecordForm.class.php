<?php

/**
 * Votingrecord form base class.
 *
 * @package    form
 * @subpackage votingrecord
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseVotingrecordForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_id'    => new sfWidgetFormInputHidden(),
      'memberstate_id' => new sfWidgetFormInputHidden(),
      'vote_type'      => new sfWidgetFormChoice(array('choices' => array('signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'))),
    ));

    $this->setValidators(array(
      'document_id'    => new sfValidatorDoctrineChoice(array('model' => 'Votingrecord', 'column' => 'document_id', 'required' => false)),
      'memberstate_id' => new sfValidatorDoctrineChoice(array('model' => 'Votingrecord', 'column' => 'memberstate_id', 'required' => false)),
      'vote_type'      => new sfValidatorChoice(array('choices' => array('signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'))),
    ));

    $this->widgetSchema->setNameFormat('votingrecord[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Votingrecord';
  }

}
