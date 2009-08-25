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
      'tag_id'           => new sfWidgetFormInputHidden(),
      'implied_tag_id'   => new sfWidgetFormInputHidden(),
      'implication_type' => new sfWidgetFormChoice(array('choices' => array('implies' => 'implies', 'suggests' => 'suggests'))),
    ));

    $this->setValidators(array(
      'tag_id'           => new sfValidatorDoctrineChoice(array('model' => 'TagImplication', 'column' => 'tag_id', 'required' => false)),
      'implied_tag_id'   => new sfValidatorDoctrineChoice(array('model' => 'TagImplication', 'column' => 'implied_tag_id', 'required' => false)),
      'implication_type' => new sfValidatorChoice(array('choices' => array('implies' => 'implies', 'suggests' => 'suggests'))),
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
