<?php

/**
 * CountryOrganisation form.
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CountryOrganisationForm extends BaseCountryOrganisationForm
{
	public function setup()
	{
		parent::setup();
		
		$years = range(1945, 2045);
		
		$this->setWidget('eff_date', new sfWidgetFormDate(array('years' => array_combine($years, $years))));
    $this->setWidget('exp_date', new sfWidgetFormDate(array('years' => array_combine($years, $years))));
	}
	
  public function configure()
  {
  }
}
