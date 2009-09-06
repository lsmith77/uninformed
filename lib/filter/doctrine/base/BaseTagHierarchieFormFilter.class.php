<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * TagHierarchie filter form base class.
 *
 * @package    filters
 * @subpackage TagHierarchie *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseTagHierarchieFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(),
      'hierarchie_level' => new sfWidgetFormChoice(array('choices' => array('' => '', 'area' => 'area', 'issue' => 'issue', 'keyword' => 'keyword'))),
      'parent_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'TagHierarchie', 'add_empty' => true)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'tags_list'        => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Tag')),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'hierarchie_level' => new sfValidatorChoice(array('required' => false, 'choices' => array('area' => 'area', 'issue' => 'issue', 'keyword' => 'keyword'))),
      'parent_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'TagHierarchie', 'column' => 'taghierarchie_id')),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'tags_list'        => new sfValidatorDoctrineChoiceMany(array('model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag_hierarchie_filters[%s]');

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
    return 'TagHierarchie';
  }

  public function getFields()
  {
    return array(
      'taghierarchie_id' => 'Number',
      'name'             => 'Text',
      'hierarchie_level' => 'Enum',
      'parent_id'        => 'ForeignKey',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'tags_list'        => 'ManyKey',
    );
  }
}