<?php

/**
 * DocumentClauseRelation form.
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentClauseRelationForm extends BaseDocumentClauseRelationForm
{
  public function configure()
  {
      $this->widgetSchema['document_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
        array(
          'model' => 'Document',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
        )
      );
      $this->widgetSchema['related_clause_body_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
        array(
          'model' => 'ClauseBody',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=clause&id=clause_body_id&action=autocomplete'),
        )
      );
  }
}
