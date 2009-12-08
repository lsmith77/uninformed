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
    sfContext::switchTo('backend');
    $this->widgetSchema['tags_list']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
    $this->widgetSchema['organisation_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['organisation_id']->setOption('renderer_options', array(
      'model' => 'Organisation',
      'id' => 'findOneByOrganisationId',
      'url'   => sfContext::getInstance()->getController()->genUrl('organisations/autocomplete'),
    ));
  }
}
