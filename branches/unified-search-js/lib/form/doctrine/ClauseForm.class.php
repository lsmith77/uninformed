<?php

/**
 * Clause form.
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClauseForm extends BaseClauseForm
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
    public function configure() {
        $this->widgetSchema['document_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
          array(
            'model' => 'Document',
            'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
          )
        );
        $this->widgetSchema['clause_body_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
          array(
            'model' => 'ClauseBody',
            'module' => 'clause_body',
            'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=clause_body&action=autocomplete'),
          )
        );
    }
}
