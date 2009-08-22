<?php

/**
 * Tags form base class.
 *
 * @package    form
 * @subpackage tags
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTagsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tag_id'   => new sfWidgetFormInputHidden(),
      'name'     => new sfWidgetFormInput(),
      'tag_type' => new sfWidgetFormChoice(array('choices' => array('legal_measure' => 'legal_measure'))),
    ));

    $this->setValidators(array(
      'tag_id'   => new sfValidatorDoctrineChoice(array('model' => 'Tags', 'column' => 'tag_id', 'required' => false)),
      'name'     => new sfValidatorString(array('max_length' => 45)),
      'tag_type' => new sfValidatorChoice(array('choices' => array('legal_measure' => 'legal_measure'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tags[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tags';
  }

}
