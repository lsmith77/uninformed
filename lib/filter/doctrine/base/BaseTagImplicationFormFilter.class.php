<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * TagImplication filter form base class.
 *
 * @package    filters
 * @subpackage TagImplication *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseTagImplicationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'implication_type' => new sfWidgetFormChoice(array('choices' => array('' => '', 'implies' => 'implies', 'suggests' => 'suggests'))),
    ));

    $this->setValidators(array(
      'implication_type' => new sfValidatorChoice(array('required' => false, 'choices' => array('implies' => 'implies', 'suggests' => 'suggests'))),
    ));

    $this->widgetSchema->setNameFormat('tag_implication_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagImplication';
  }

  public function getFields()
  {
    return array(
      'tag_id'           => 'Number',
      'implied_tag_id'   => 'Number',
      'implication_type' => 'Enum',
    );
  }
}