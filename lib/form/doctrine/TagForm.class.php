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
    $this->widgetSchema['created_at'] = new myWidgetFormPlain();
    $this->widgetSchema['updated_at'] = new myWidgetFormPlain();
  }

  public function updateCreatedAtColumn()
  {
    return false;
  }

  public function updateUpdatedAtColumn()
  {
    return false;
  }
}
