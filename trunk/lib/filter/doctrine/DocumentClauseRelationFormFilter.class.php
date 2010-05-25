<?php

/**
 * DocumentClauseRelation filter form.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentClauseRelationFormFilter extends BaseDocumentClauseRelationFormFilter
{
  public function configure()
  {
      $this->widgetSchema['document_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(
        array(
          'model' => 'Document',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
        )
      );
      $this->widgetSchema['related_clause_body_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(
        array(
          'model' => 'ClauseBody',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=clause&id=clause_body_idaction=autocomplete'),
        )
      );
  }
}
