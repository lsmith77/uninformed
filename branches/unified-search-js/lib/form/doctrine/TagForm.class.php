<?php

/**
 * Tag form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TagForm extends BaseTagForm
{
  public function configure()
  {
      $this->widgetSchema['documents_list'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
        array(
          'renderer_class' => 'sfWidgetFormSelectDoubleList',
          'model' => 'Document',
          'multiple' => true,
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
        )
      );
      $this->widgetSchema['clause_bodies_list'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
        array(
          'renderer_class' => 'sfWidgetFormSelectDoubleList',
          'model' => 'ClauseBody',
          'multiple' => true,
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=clause&id=clause_body_id&action=autocomplete'),
        )
      );
  }
}
