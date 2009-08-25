<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * TagHierachie filter form base class.
 *
 * @package    filters
 * @subpackage TagHierachie *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseTagHierachieFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(),
      'hierachie_level'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'area' => 'area', 'issue' => 'issue', 'keyword' => 'keyword'))),
      'parent_taghierachie_id' => new sfWidgetFormFilterInput(),
      'tags_list'              => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Tag')),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'hierachie_level'        => new sfValidatorChoice(array('required' => false, 'choices' => array('area' => 'area', 'issue' => 'issue', 'keyword' => 'keyword'))),
      'parent_taghierachie_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tags_list'              => new sfValidatorDoctrineChoiceMany(array('model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag_hierachie_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addTagsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.TagHierarchieTag TagHierarchieTag')
          ->andWhereIn('TagHierarchieTag.tag_id', $values);
  }

  public function getModelName()
  {
    return 'TagHierachie';
  }

  public function getFields()
  {
    return array(
      'taghierarchie_id'       => 'Number',
      'name'                   => 'Text',
      'hierachie_level'        => 'Enum',
      'parent_taghierachie_id' => 'Number',
      'tags_list'              => 'ManyKey',
    );
  }
}