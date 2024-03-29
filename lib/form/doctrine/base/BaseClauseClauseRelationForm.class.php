<?php

/**
 * ClauseClauseRelation form base class.
 *
 * @method ClauseClauseRelation getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClauseClauseRelationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'type'              => new sfWidgetFormChoice(array('choices' => array('recalls' => 'recalls', 'closely related' => 'closely related'))),
      'clause_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Clause'), 'add_empty' => false)),
      'related_clause_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseRelated'), 'add_empty' => false)),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'author_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'type'              => new sfValidatorChoice(array('choices' => array(0 => 'recalls', 1 => 'closely related'))),
      'clause_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Clause'))),
      'related_clause_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ClauseRelated'))),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'author_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ClauseClauseRelation', 'column' => array('clause_id', 'related_clause_id', 'type')))
    );

    $this->widgetSchema->setNameFormat('clause_clause_relation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClauseClauseRelation';
  }

}
