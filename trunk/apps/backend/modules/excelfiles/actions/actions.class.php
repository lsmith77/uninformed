<?php

require_once dirname(__FILE__).'/../lib/excelfilesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/excelfilesGeneratorHelper.class.php';

/**
 * excelfiles actions.
 *
 * @package    docdb
 * @subpackage excelfiles
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class excelfilesActions extends autoExcelfilesActions
{
  public function executeImportSpreadsheet($request)
  {
    $excelFileId = $request->getParameter('id');
    $excelFileData = Doctrine::getTable('ExcelFile')->findById($excelFileId)->getFirst();

    $documentImport = new documentImportFromExcel('uploads/'.$excelFileData['file']);

    $documentImport->process();
    $documentImport->save();

    $excelFileData->setIsImported(true);
    $excelFileData->save();

    $this->redirect('excel_file_excelfiles');
  }
}
