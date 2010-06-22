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
    public function configure() {
        $years = range(1900, date('Y'));
        $dateWidget = new sfWidgetFormDate(array('years' => array_combine($years, $years)));
        $this->widgetSchema['enforcement_date'] = new sfWidgetFormJQueryDate(array('date_widget' => $dateWidget));
        $this->widgetSchema['adoption_date'] = new sfWidgetFormJQueryDate(array('date_widget' => $dateWidget));
        $this->widgetSchema['parent_document_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
          array(
            'model' => 'Document',
            'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
          )
        );
        $this->widgetSchema['organisation_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
          array(
            'model' => 'Organisation',
            'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=organisation&action=autocomplete'),
          )
        );
        $this->widgetSchema['tags_list'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
          array(
            'renderer_class' => 'sfWidgetFormSelectDoubleList',
            'model' => 'Tag',
            'multiple' => true,
            'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=tag&action=autocomplete'),
          )
        );
    }
}
