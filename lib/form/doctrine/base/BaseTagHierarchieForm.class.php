<?php

/**
 * TagHierarchie form base class.
 *
 * @package    form
 * @subpackage tag_hierarchie
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTagHierarchieForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'taghierarchie_id'        => new sfWidgetFormInputHidden(),
      'name'                    => new sfWidgetFormInput(),
      'hierachie_level'         => new sfWidgetFormChoice(array('choices' => array('area' => 'area', 'issue' => 'issue', 'keyword' => 'keyword'))),
      'parent_taghierarchie_id' => new sfWidgetFormInput(),
      'tags_list'               => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Tag')),
    ));

    $this->setValidators(array(
      'taghierarchie_id'        => new sfValidatorDoctrineChoice(array('model' => 'TagHierarchie', 'column' => 'taghierarchie_id', 'required' => false)),
      'name'                    => new sfValidatorString(array('max_length' => 45)),
      'hierachie_level'         => new sfValidatorChoice(array('choices' => array('area' => 'area', 'issue' => 'issue', 'keyword' => 'keyword'))),
      'parent_taghierarchie_id' => new sfValidatorInteger(array('required' => false)),
      'tags_list'               => new sfValidatorDoctrineChoiceMany(array('model' => 'Tag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag_hierarchie[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagHierarchie';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['tags_list']))
    {
      $this->setDefault('tags_list', $this->object->Tags->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveTagsList($con);
  }

  public function saveTagsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tags_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Tags->getPrimaryKeys();
    $values = $this->getValue('tags_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Tags', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Tags', array_values($link));
    }
  }

}
