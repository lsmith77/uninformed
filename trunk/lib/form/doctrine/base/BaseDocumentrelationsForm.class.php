<?php

/**
 * Documentrelations form base class.
 *
 * @package    form
 * @subpackage documentrelations
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseDocumentrelationsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_id'         => new sfWidgetFormInputHidden(),
      'related_document_id' => new sfWidgetFormInputHidden(),
      'relation_type'       => new sfWidgetFormInputHidden(array('choices' => array('followup' => 'followup', 'recalls' => 'recalls', 'report' => 'report'))),
    ));

    $this->setValidators(array(
      'document_id'         => new sfValidatorDoctrineChoice(array('model' => 'Documentrelations', 'column' => 'document_id', 'required' => false)),
      'related_document_id' => new sfValidatorDoctrineChoice(array('model' => 'Documentrelations', 'column' => 'related_document_id', 'required' => false)),
      'relation_type'       => new sfValidatorDoctrineChoice(array('model' => 'Documentrelations', 'column' => 'relation_type', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documentrelations[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentrelations';
  }

}
