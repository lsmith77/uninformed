<?php

/**
 * Project form base class.
 *
 * @package    form
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
    if ($this->isNew()) {
      unset($this->widgetSchema['created_at']);
      unset($this->widgetSchema['updated_at']);
    } else {
      $this->widgetSchema['created_at'] = new myWidgetFormPlain();
      $this->widgetSchema['updated_at'] = new myWidgetFormPlain();
    }
  }
}
