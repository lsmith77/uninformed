<?php

/**
 * ClauseBodyTaggableTag form base class.
 *
 * @method ClauseBodyTaggableTag getObject() Returns the current form's model object
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseClauseBodyTaggableTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'tag_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'tag_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'tag_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('clause_body_taggable_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClauseBodyTaggableTag';
  }

}
