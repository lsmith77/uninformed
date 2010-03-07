<?php

/**
 * Organisation form.
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrganisationForm extends BaseOrganisationForm
{
    public function setup()
    {
        parent::setup();
        if ($this->isNew()) {
            unset($this->widgetSchema['slug']);
        } else {
            $this->setWidget('slug', new sfWidgetFormPlain(array('value'=>$this->getObject()->slug)));
        }
        
        sfContext::switchTo('backend');
        //$this->widgetSchema['tags_list']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
        $this->widgetSchema['parent_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
        $this->widgetSchema['parent_id']->setOption('renderer_options', array(
          'model' => 'Organisation',
          //'id' => 'findOneByOrganisationId',
          'url'   => sfContext::getInstance()->getController()->genUrl('organisation/autocomplete'),
        ));
    }
}
