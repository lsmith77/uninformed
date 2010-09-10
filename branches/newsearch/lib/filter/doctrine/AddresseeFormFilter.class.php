<?php

/**
 * Addressee filter form.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AddresseeFormFilter extends BaseAddresseeFormFilter
{
  public function configure()
  {
    parent::configure();

    sfContext::switchTo('backend');

    $this->widgetSchema['quick edit search'] = new sfWidgetFormDoctrineJQueryQuickSearchAutocompleter(
      array(
        'model' => 'Addressee',
        'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=addressee&action=autocomplete'),
      )
    );
    $this->validatorSchema['quick edit search'] = new sfValidatorPass ();
  }

  public function getFields()
  {
    $fields = parent::getFields();
    $fields['document'] = 'custom';

    return $fields;
  }

	public function addDocumentColumnQuery($query, $field, $value)
	{
	  Doctrine::getTable('Addressee')
	    ->applyDocumentFilter($query, $value);
	}
}
