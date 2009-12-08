<?php

/**
 * TagHierarchie form.
 *
 * @package    form
 * @subpackage TagHierarchie
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class TagHierarchieForm extends BaseTagHierarchieForm
{
  public function configure()
  {
    $this->widgetSchema['tags_list']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
  }
}