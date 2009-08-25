<?php

/**
 * TagHierachieTag form base class.
 *
 * @package    form
 * @subpackage tag_hierachie_tag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTagHierachieTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'taghierachie_id' => new sfWidgetFormInputHidden(),
      'tag_id'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'taghierachie_id' => new sfValidatorDoctrineChoice(array('model' => 'TagHierachieTag', 'column' => 'taghierachie_id', 'required' => false)),
      'tag_id'          => new sfValidatorDoctrineChoice(array('model' => 'TagHierachieTag', 'column' => 'tag_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag_hierachie_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagHierachieTag';
  }

}
