<?php

/**
 * Vote filter form.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VoteFormFilter extends BaseVoteFormFilter
{
  public function configure()
  {
      $this->widgetSchema['document_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
        array(
          'model' => 'Document',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
        )
      );
      $this->widgetSchema['country_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
        array(
          'model' => 'Country',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=country&action=autocomplete'),
        )
      );
  }
}
