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
    
    /*
     * Tried sfPHPExcel using PHPExcel. Does not work for me so far.
     * Checking it out again later. Please feel free to try it yourself.
     * 
     * @author  Dennis Riedel
     */
    //$objPHPExcel = new sfPhpExcel();
    //$objPHPExcel = PHPExcel_IOFactory::load('uploads/Template_PoP_JULY2009_malariaII.xls');
    
    
    $data = new spreadsheetExcelReader('uploads/Template_PoP_JULY2009_malariaII.xls');
    
    $useSheet = 0;
    $startRow = 1;
    $startColumn = 2;
    
    $countDocAttrColumns = 16; //No. of Excel columns used for UN document attributes
    
    /*
     * The following code extracts all documents from the Excel.
     * The document name is used as key in an assoc array.
     * Therefore the multiple lines of one document due to the different
     * clauses result in one document entry because the value part gets
     * overridden in the for loop. Maybe there is a better way
     * 
     * TODO: Non obligatory document attributes, Clauses and Tags
     */
    $documentTitle = "";
    $documentAttributes = array();
    $documents = array();
    
    $amountOfUsedRows = $data->rowcount($useSheet);
    
    for($j = $startRow + 1; $j <= $amountOfUsedRows; $j++)
    {
      $documentTitle = trim($data->value($j,$startColumn,$useSheet));
      
      if($documentTitle != "")
      {
        for($i = 1; $i <= $countDocAttrColumns; $i++)
        {
          $documentAttributes[$i] = $data->raw($j,$i+$startColumn,$useSheet);
        }
        
        $documents[$documentTitle] = $documentAttributes;
      }
    }
    
    $this->saveImportedDocuments($documents);
  }
  
  /**
   * 
   * @param $documentsAssocArray
   * @return unknown_type
   */
  private function saveImportedDocuments($documentsAssocArray)
  {
    foreach($documentsAssocArray as $name => $attributes)
    {
      $document = new Document();
      $document->set('name', $name);
      
      $adoptiondateFormatted = $this->createDate($attributes[2]);
      if(is_null($adoptiondateFormatted))
      {
        $document->set('adoption_date', "1945-10-24");
      }
      else
      {
        $document->set('adoption_date', $this->createDate($attributes[2]));
      }
    
      $document->save();
    }
  }
  
  /**
   * TODO: Refactor in module helper class
   * 
   * @param $dateString
   * @return date string
   */
  private function createDate($dateInteger)
  {
    $dateInteger = trim($dateInteger);
    $dateInteger = explode(" ", $dateInteger);
    
    if($dateInteger[0] > 0 && $dateInteger[0] != "" && !(count($dateInteger) > 1))
    {
      $oneDayInSeconds = 24 * 60 * 60;
      $utcDateInExcel = 25569; //number of days since 1-1-1900 until 1-1-1970
      $utcDateInExcelInSeconds = $utcDateInExcel * $oneDayInSeconds;
      $excelDateInSeconds = $dateInteger[0] * $oneDayInSeconds;
      
      $dateInUtcTimestamp = $excelDateInSeconds - $utcDateInExcelInSeconds;
      
      return date("Y-m-d", $dateInUtcTimestamp);
    }
    else
    {
      return NULL;
    }
  }
}
