<?php

/**
 * DocumentTag form base class.
 *
 * @package    form
 * @subpackage document_tag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseDocumentTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_id' => new sfWidgetFormInputHidden(),
      'tag_id'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'document_id' => new sfValidatorDoctrineChoice(array('model' => 'DocumentTag', 'column' => 'document_id', 'required' => false)),
      'tag_id'      => new sfValidatorDoctrineChoice(array('model' => 'DocumentTag', 'column' => 'tag_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentTag';
  }

}
