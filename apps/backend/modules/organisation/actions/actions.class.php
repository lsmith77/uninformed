<?php

require_once dirname(__FILE__).'/../lib/organisationGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/organisationGeneratorHelper.class.php';

/**
 * organisation actions.
 *
 * @package    uninformed
 * @subpackage organisation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class organisationActions extends autoOrganisationActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->organisations = Doctrine::getTable('Organisation')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->organisation = Doctrine::getTable('Organisation')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->organisation);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new OrganisationForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new OrganisationForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($organisation = Doctrine::getTable('Organisation')->find(array($request->getParameter('id'))), sprintf('Object organisation does not exist (%s).', $request->getParameter('id')));
    $this->form = new OrganisationForm($organisation);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($organisation = Doctrine::getTable('Organisation')->find(array($request->getParameter('id'))), sprintf('Object organisation does not exist (%s).', $request->getParameter('id')));
    $this->form = new OrganisationForm($organisation);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($organisation = Doctrine::getTable('Organisation')->find(array($request->getParameter('id'))), sprintf('Object organisation does not exist (%s).', $request->getParameter('id')));
    $organisation->delete();

    $this->redirect('organisation/index');
  }

  public function executeAutocomplete($request)
  {
    return autocompleteHelper::executeAutocomplete($this, $request, 'Organisation', 'id');
  }  
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $organisation = $form->save();

      $this->redirect('organisation/edit?id='.$organisation->getId());
    }
  }
}
