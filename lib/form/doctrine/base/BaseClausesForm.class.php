<?php

/**
 * Clauses form base class.
 *
 * @package    form
 * @subpackage clauses
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseClausesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'clause_id'        => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInput(),
      'document_id'      => new sfWidgetFormDoctrineChoice(array('model' => 'Documents', 'add_empty' => false)),
      'clause_number'    => new sfWidgetFormInput(),
      'parent_clause_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Clauses', 'add_empty' => true)),
      'information_type' => new sfWidgetFormInput(),
      'operative_phrase' => new sfWidgetFormInput(),
      'adressee'         => new sfWidgetFormInput(),
      'relevance'        => new sfWidgetFormInput(),
      'significants'     => new sfWidgetFormInput(),
      'content'          => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'clause_id'        => new sfValidatorDoctrineChoice(array('model' => 'Clauses', 'column' => 'clause_id', 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 45)),
      'document_id'      => new sfValidatorDoctrineChoice(array('model' => 'Documents')),
      'clause_number'    => new sfValidatorInteger(),
      'parent_clause_id' => new sfValidatorDoctrineChoice(array('model' => 'Clauses', 'required' => false)),
      'information_type' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'operative_phrase' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'adressee'         => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'relevance'        => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'significants'     => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'content'          => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clauses[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Clauses';
  }

}
