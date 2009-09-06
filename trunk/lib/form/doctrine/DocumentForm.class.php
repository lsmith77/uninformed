<?php

/**
 * Document form.
 *
 * @package    form
 * @subpackage Document
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class DocumentForm extends BaseDocumentForm
{
  public function configure()
  {
    $this->widgetSchema['tags_list']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
  }
}