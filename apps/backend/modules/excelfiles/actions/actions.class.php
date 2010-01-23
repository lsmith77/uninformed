<?php

/**
 * excelfiles actions.
 *
 * @package    uninformed
 * @subpackage excelfiles
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class excelfilesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->excel_files = Doctrine::getTable('ExcelFile')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->excel_file = Doctrine::getTable('ExcelFile')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->excel_file);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ExcelFileForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ExcelFileForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($excel_file = Doctrine::getTable('ExcelFile')->find(array($request->getParameter('id'))), sprintf('Object excel_file does not exist (%s).', $request->getParameter('id')));
    $this->form = new ExcelFileForm($excel_file);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($excel_file = Doctrine::getTable('ExcelFile')->find(array($request->getParameter('id'))), sprintf('Object excel_file does not exist (%s).', $request->getParameter('id')));
    $this->form = new ExcelFileForm($excel_file);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($excel_file = Doctrine::getTable('ExcelFile')->find(array($request->getParameter('id'))), sprintf('Object excel_file does not exist (%s).', $request->getParameter('id')));
    $excel_file->delete();

    $this->redirect('excelfiles/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $file = $form->getValue('file');
      
      $filename = 'uploaded_'.sha1($file->getOriginalName());
      $extension = $file->getExtension($file->getOriginalExtension());
      $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
    	
      $excel_file = $form->save();

      $this->redirect('excelfiles/edit?id='.$excel_file->getId());
    }
  }
}
