<?php

/**
 * TagHierarchieTag form base class.
 *
 * @package    form
 * @subpackage tag_hierarchie_tag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTagHierarchieTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'taghierarchie_id' => new sfWidgetFormInputHidden(),
      'tag_id'           => new sfWidgetFormInputHidden(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'taghierarchie_id' => new sfValidatorDoctrineChoice(array('model' => 'TagHierarchieTag', 'column' => 'taghierarchie_id', 'required' => false)),
      'tag_id'           => new sfValidatorDoctrineChoice(array('model' => 'TagHierarchieTag', 'column' => 'tag_id', 'required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag_hierarchie_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagHierarchieTag';
  }

}
