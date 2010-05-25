<?php

/**
 * ClauseClauseRelation filter form.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClauseClauseRelationFormFilter extends BaseClauseClauseRelationFormFilter
{
  public function configure()
  {
      $this->widgetSchema['clause_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(
        array(
          'model' => 'Clause',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=clause&action=autocomplete'),
        )
      );
      $this->widgetSchema['related_clause_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(
        array(
          'model' => 'Clause',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=clause&action=autocomplete'),
        )
      );
  }
}
