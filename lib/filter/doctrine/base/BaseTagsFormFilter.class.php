<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Tags filter form base class.
 *
 * @package    filters
 * @subpackage Tags *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseTagsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'     => new sfWidgetFormFilterInput(),
      'tag_type' => new sfWidgetFormChoice(array('choices' => array('' => '', 'legal_measure' => 'legal_measure'))),
    ));

    $this->setValidators(array(
      'name'     => new sfValidatorPass(array('required' => false)),
      'tag_type' => new sfValidatorChoice(array('required' => false, 'choices' => array('legal_measure' => 'legal_measure'))),
    ));

    $this->widgetSchema->setNameFormat('tags_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tags';
  }

  public function getFields()
  {
    return array(
      'tag_id'   => 'Number',
      'name'     => 'Text',
      'tag_type' => 'Enum',
    );
  }
}