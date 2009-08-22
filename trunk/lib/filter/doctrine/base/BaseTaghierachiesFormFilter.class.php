<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Taghierachies filter form base class.
 *
 * @package    filters
 * @subpackage Taghierachies *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseTaghierachiesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(),
      'hierachie_level'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'area' => 'area', 'issue' => 'issue', 'keyword' => 'keyword'))),
      'parent_taghierachie_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Taghierachies', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'hierachie_level'        => new sfValidatorChoice(array('required' => false, 'choices' => array('area' => 'area', 'issue' => 'issue', 'keyword' => 'keyword'))),
      'parent_taghierachie_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Taghierachies', 'column' => 'taghierarchie_id')),
    ));

    $this->widgetSchema->setNameFormat('taghierachies_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Taghierachies';
  }

  public function getFields()
  {
    return array(
      'taghierarchie_id'       => 'Number',
      'name'                   => 'Text',
      'hierachie_level'        => 'Enum',
      'parent_taghierachie_id' => 'ForeignKey',
    );
  }
}