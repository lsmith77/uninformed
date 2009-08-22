<?php

/**
 * Clause2tag form base class.
 *
 * @package    form
 * @subpackage clause2tag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseClause2tagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'clause_id' => new sfWidgetFormInputHidden(),
      'tag_id'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'clause_id' => new sfValidatorDoctrineChoice(array('model' => 'Clause2tag', 'column' => 'clause_id', 'required' => false)),
      'tag_id'    => new sfValidatorDoctrineChoice(array('model' => 'Clause2tag', 'column' => 'tag_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clause2tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Clause2tag';
  }

}
