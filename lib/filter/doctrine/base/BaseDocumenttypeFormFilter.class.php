<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Documenttype filter form base class.
 *
 * @package    filters
 * @subpackage Documenttype *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseDocumenttypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'            => new sfWidgetFormFilterInput(),
      'legal_value_id'  => new sfWidgetFormDoctrineChoice(array('model' => 'LegalValue', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'            => new sfValidatorPass(array('required' => false)),
      'legal_value_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'LegalValue', 'column' => 'legal_value_id')),
    ));

    $this->widgetSchema->setNameFormat('documenttype_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documenttype';
  }

  public function getFields()
  {
    return array(
      'documenttype_id' => 'Number',
      'name'            => 'Text',
      'legal_value_id'  => 'ForeignKey',
    );
  }
}