<?php

/**
 * ClauseBody form.
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClauseBodyForm extends BaseClauseBodyForm
{
  public function configure()
  {
      $this->widgetSchema['parent_clause_body_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
        array(
          'model' => 'ClauseBody',
          'module' => 'clause_body',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=clause_body&action=autocomplete'),
        )
      );

      $this->widgetSchema['root_clause_body_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
        array(
          'model' => 'ClauseBody',
          'module' => 'clause_body',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=clause_body&action=autocomplete'),
        )
      );
  }
}
