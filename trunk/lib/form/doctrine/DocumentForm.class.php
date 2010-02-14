<?php

/**
 * Document form.
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentForm extends BaseDocumentForm
{
    public function setup()
    {
        parent::setup();
        if ($this->isNew()) {
            unset($this->widgetSchema['slug']);
        } else {
            $this->setWidget('slug', new sfWidgetFormPlain(array('value'=>$this->getObject()->slug)));
        }
    }
}
