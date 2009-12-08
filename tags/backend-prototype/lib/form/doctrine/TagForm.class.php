<?php

/**
 * Tag form.
 *
 * @package    form
 * @subpackage Tag
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class TagForm extends BaseTagForm
{
  public function configure()
  {
    $this->widgetSchema['clauses_list']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
    $this->widgetSchema['documents_list']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
    $this->widgetSchema['tag_hierarchies_list']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
  }
}