<?php

/**
 * Project form base class.
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
    public function setup()
    {
        parent::setup();
        if (isset($this->widgetSchema['created_at'])) {
            if ($this->isNew()) {
                unset($this->widgetSchema['created_at']);
                unset($this->widgetSchema['updated_at']);
            } else {
                $this->setWidget('created_at', new sfWidgetFormPlain(array('value'=>$this->getObject()->created_at)));
                $this->setWidget('updated_at', new sfWidgetFormPlain(array('value'=>$this->getObject()->updated_at)));
            }
            unset($this->validatorSchema['created_at']);
            unset($this->validatorSchema['updated_at']);
        }
//var_dump(($this->getObject()->revert(1957896241)));
        if (isset($this->widgetSchema['version']) && substr(get_class($this), -11) !== 'VersionForm') {
            if ($this->isNew()) {
                unset($this->widgetSchema['version']);
            } else {
                $this->setWidget('version', new sfWidgetFormPlain(array('value'=>$this->getObject()->version)));
            }
            unset($this->validatorSchema['version']);
        }
    }
}
