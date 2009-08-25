<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Votingrecord filter form base class.
 *
 * @package    filters
 * @subpackage Votingrecord *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseVotingrecordFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'vote_type'      => new sfWidgetFormChoice(array('choices' => array('' => '', 'signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'))),
    ));

    $this->setValidators(array(
      'vote_type'      => new sfValidatorChoice(array('required' => false, 'choices' => array('signed' => 'signed', 'agreed' => 'agreed', 'no' => 'no', 'abstain' => 'abstain', 'missing' => 'missing'))),
    ));

    $this->widgetSchema->setNameFormat('votingrecord_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Votingrecord';
  }

  public function getFields()
  {
    return array(
      'document_id'    => 'Number',
      'memberstate_id' => 'Number',
      'vote_type'      => 'Enum',
    );
  }
}