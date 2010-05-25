<?php

/**
 * DocumentDocumentRelation filter form.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentDocumentRelationFormFilter extends BaseDocumentDocumentRelationFormFilter
{
  public function configure()
  {
      $this->widgetSchema['document_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(
        array(
          'model' => 'Document',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
        )
      );
      $this->widgetSchema['related_document_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(
        array(
          'model' => 'Document',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
        )
      );
  }
}
