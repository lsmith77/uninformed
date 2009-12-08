<?php

/**
 * TagImplication form base class.
 *
 * @package    form
 * @subpackage tag_implication
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTagImplicationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'implication_type' => new sfWidgetFormChoice(array('choices' => array('implies' => 'implies', 'suggests' => 'suggests'))),
      'tag_left_hand'    => new sfWidgetFormInput(),
      'tag_right_hand'   => new sfWidgetFormDoctrineChoice(array('model' => 'Tag', 'add_empty' => false)),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => 'TagImplication', 'column' => 'id', 'required' => false)),
      'implication_type' => new sfValidatorChoice(array('choices' => array('implies' => 'implies', 'suggests' => 'suggests'))),
      'tag_left_hand'    => new sfValidatorInteger(),
      'tag_right_hand'   => new sfValidatorDoctrineChoice(array('model' => 'Tag')),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag_implication[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagImplication';
  }

}
