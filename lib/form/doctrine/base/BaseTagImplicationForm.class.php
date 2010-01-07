<?php

/**
 * TagImplication form base class.
 *
 * @method TagImplication getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTagImplicationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'implication_type' => new sfWidgetFormChoice(array('choices' => array('implies' => 'implies', 'suggests' => 'suggests'))),
      'tag_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tag'), 'add_empty' => false)),
      'implied_tag_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TagImplied'), 'add_empty' => false)),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'author_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'version'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'implication_type' => new sfValidatorChoice(array('choices' => array('implies' => 'implies', 'suggests' => 'suggests'))),
      'tag_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tag'))),
      'implied_tag_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TagImplied'))),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'author_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'version'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'TagImplication', 'column' => array('tag_id', 'implied_tag_id')))
    );

    $this->widgetSchema->setNameFormat('tag_implication[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagImplication';
  }

}
