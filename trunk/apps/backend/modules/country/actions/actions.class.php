<?php

/**
 * country actions.
 *
 * @package    uninformed
 * @subpackage country
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class countryActions extends sfActions
{
  public function executeImport()
  {
  	$countryExcel = new spreadsheetExcelReader('uploads/isoCountry.xls');
  	
  	$countRows = $countryExcel->rowcount(0);
  	
  	$countries = array();
  	for($i = 1; $i <= $countRows; $i++) //rows
  	{
  		$iso = trim($countryExcel->value($i,1,0));
      $name = trim($countryExcel->value($i,2,0));
  		
      $countries[$iso] = $name;
  	}
  	
  	foreach($countries as $iso => $name)
  	{
  		$country = new Country();
      $country->set('iso', $iso);
      $country->set('name', $name);
      
      $country->save();
      
      $handle = fopen('uploads/countries.yml', "a");
      
      $content = "  ".$name.":\r\n";
      $content .= "    iso:".$iso."\r\n";
      $content .= "    name:".$name."\r\n";
      
      fwrite($handle,$content,strlen($content));
      
      fclose($handle);
  	}
  }
	
	public function executeIndex(sfWebRequest $request)
  {
    $this->countrys = Doctrine::getTable('Country')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->country = Doctrine::getTable('Country')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->country);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CountryForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CountryForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($country = Doctrine::getTable('Country')->find(array($request->getParameter('id'))), sprintf('Object country does not exist (%s).', $request->getParameter('id')));
    $this->form = new CountryForm($country);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($country = Doctrine::getTable('Country')->find(array($request->getParameter('id'))), sprintf('Object country does not exist (%s).', $request->getParameter('id')));
    $this->form = new CountryForm($country);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($country = Doctrine::getTable('Country')->find(array($request->getParameter('id'))), sprintf('Object country does not exist (%s).', $request->getParameter('id')));
    $country->delete();

    $this->redirect('country/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $country = $form->save();

      $this->redirect('country/edit?id='.$country->getId());
    }
  }
}
