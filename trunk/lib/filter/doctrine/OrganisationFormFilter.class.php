<?php

/**
 * Organisation filter form.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrganisationFormFilter extends BaseOrganisationFormFilter
{
  public function configure()
  {
  	parent::configure();
    
    sfContext::switchTo('backend');
    
    $this->widgetSchema['name'] = new sfWidgetFormDoctrineJQueryAutocompleter(
      array(
        'model' => 'Organisation',
        'url'   => sfContext::getInstance()->getController()->genUrl('organisation/autocomplete'),
      )
    );
    
    $this->validatorSchema['name'] = new sfValidatorPass ();
  }
}
