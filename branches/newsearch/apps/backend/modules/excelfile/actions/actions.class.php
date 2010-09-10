<?php

require_once dirname(__FILE__).'/../lib/excelfileGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/excelfileGeneratorHelper.class.php';

/**
 * excelfile actions.
 *
 * @package    uninformed
 * @subpackage excelfile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class excelfileActions extends autoExcelfileActions
{
  public function executeExcelSpreadsheetImport($request)
  {
    try {
      $excelFileId = $request->getParameter('id');
      $excelFileData = Doctrine::getTable('ExcelFile')->findById($excelFileId)->getFirst();

      $this->documents = $this->error = null;
      if ($excelFileData) {
        set_time_limit(3600);
        Doctrine_Manager::connection()->beginTransaction();
        $import = new excelSpreadsheetImport();
        $this->documents = $import->loadDataFromFile($excelFileData['file']);
        $import->saveData($excelFileId, $this->documents);

        $excelFileData->setIsImported(true);
        $excelFileData->save();
        Doctrine_Manager::connection()->commit();
      }
    } catch (Exception $e) {
      Doctrine_Manager::connection()->rollback();
        $this->error = $e;
    }

//    $this->redirect('excel_file');
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

      $this->redirect('excelfile/edit?id='.$excel_file->getId());
    }
  }
}
