<?php

/**
 * Taghierachies form base class.
 *
 * @package    form
 * @subpackage taghierachies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTaghierachiesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'taghierarchie_id'       => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInput(),
      'hierachie_level'        => new sfWidgetFormChoice(array('choices' => array('area' => 'area', 'issue' => 'issue', 'keyword' => 'keyword'))),
      'parent_taghierachie_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Taghierachies', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'taghierarchie_id'       => new sfValidatorDoctrineChoice(array('model' => 'Taghierachies', 'column' => 'taghierarchie_id', 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 45)),
      'hierachie_level'        => new sfValidatorChoice(array('choices' => array('area' => 'area', 'issue' => 'issue', 'keyword' => 'keyword'))),
      'parent_taghierachie_id' => new sfValidatorDoctrineChoice(array('model' => 'Taghierachies', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('taghierachies[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Taghierachies';
  }

}
