<?php

/**
 * import actions.
 *
 * @package    docdb
 * @subpackage import
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class importActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  /**
   * Executes import action
   * 
   * Imports an Excel files uploaded to web/uploads/
   * 
   * @author  Dennis Riedel
   */
  public function executeImport()
  {
    /*
     * Using sfFinder class to look up uploaded Excel files.
     * We could use this in the future to import newly uploaded files
     * from a repository folder.
     * 
     * @author  Dennis Riedel
     
    $excelFiles = sfFinder::type('file')
      ->name('*.xls')
       ->in('/xampp/htdocs/un-informed.org/web/uploads/');
    
    $data = new spreadsheetExcelReader($excelFiles[0]);
    */
    
    $documentImport = new documentImportFromExcel('uploads/Template_PoP_JULY2009_malariaII.xls');
    //$documentImport = new documentImportFromExcel('uploads/new.water20090910_roxana_hannah_new templateII.xls');
    
    $documentImport->process();
    $documentImport->save();
  }
}
