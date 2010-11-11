<?php

/**
 * Tag filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TagFormFilter extends BaseTagFormFilter
{
    public function configure()
    {
      parent::configure();

      sfContext::switchTo('backend');

      $this->widgetSchema['quick edit search'] = new sfWidgetFormDoctrineJQueryQuickSearchAutocompleter(
        array(
          'model' => 'Tag',
          'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=tag&action=autocomplete'),
        )
      );
      $this->validatorSchema['quick edit search'] = new sfValidatorPass ();
    }
}
