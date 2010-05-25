<?php

/**
 * DocumentDocumentRelation form.
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentDocumentRelationForm extends BaseDocumentDocumentRelationForm
{
  public function configure()
  {
      $this->widgetSchema['document_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
        array(
          'model' => 'Document',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
        )
      );
      $this->widgetSchema['related_document_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
        array(
          'model' => 'Document',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
        )
      );
  }
}
