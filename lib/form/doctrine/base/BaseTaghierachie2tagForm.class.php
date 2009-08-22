<?php

/**
 * Taghierachie2tag form base class.
 *
 * @package    form
 * @subpackage taghierachie2tag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTaghierachie2tagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'taghierachie_id' => new sfWidgetFormInputHidden(),
      'tag_id'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'taghierachie_id' => new sfValidatorDoctrineChoice(array('model' => 'Taghierachie2tag', 'column' => 'taghierachie_id', 'required' => false)),
      'tag_id'          => new sfValidatorDoctrineChoice(array('model' => 'Taghierachie2tag', 'column' => 'tag_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('taghierachie2tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Taghierachie2tag';
  }

}
