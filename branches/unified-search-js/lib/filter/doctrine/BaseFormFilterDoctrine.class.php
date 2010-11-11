<?php

/**
 * Project filter form base class.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup()
  {
    foreach ($this->widgetSchema->getFields() as $name => $widget) {
      if ($widget instanceof sfWidgetFormFilterDate) {
        $this->widgetSchema[$name] = new sfWidgetFormJQueryDate(array(
//          'image'=>'/images/calendar.gif',
        ));
      }
    }
  }
}
