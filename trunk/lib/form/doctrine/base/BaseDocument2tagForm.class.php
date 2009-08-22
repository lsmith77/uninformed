<?php

/**
 * Document2tag form base class.
 *
 * @package    form
 * @subpackage document2tag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseDocument2tagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_id' => new sfWidgetFormInputHidden(),
      'tag_id'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'document_id' => new sfValidatorDoctrineChoice(array('model' => 'Document2tag', 'column' => 'document_id', 'required' => false)),
      'tag_id'      => new sfValidatorDoctrineChoice(array('model' => 'Document2tag', 'column' => 'tag_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document2tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Document2tag';
  }

}
