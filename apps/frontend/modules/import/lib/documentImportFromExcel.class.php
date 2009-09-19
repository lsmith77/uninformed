<?php
class documentImportFromExcel
{
  var $excelFile;
  var $excelData;
  var $documents; //will contain all documents and their attributes
  
  function documentImportFromExcel($excelFile)
  {
    /*
     * Possible alternative to php excel reader2: sfPHPExcel
     */
    //$objPHPExcel = new sfPhpExcel();
    //$objPHPExcel = PHPExcel_IOFactory::load($this->excelFile);
    
    $this->excelFile = $excelFile;
    $this->excelData = new spreadsheetExcelReader($this->excelFile);
    
    $this->documents = array();
  }
  
  public function process()
  {
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
    $documentAttributes = array(); //will contain document columns
    $documentIdentifiers = array(); //will contain ids of saved documents
    
    $amountOfUsedRows = $this->excelData->rowcount($useSheet);
    
    for($j = $startRow + 1; $j <= $amountOfUsedRows; $j++)
    {
      $documentTitle = trim($this->excelData->value($j,$startColumn,$useSheet));
      
      if($documentTitle != "") //document name is obligatory
      {
        for($i = 1; $i <= $countDocAttrColumns; $i++)
        {
          if($i == 2) //check whether actual column is date column
          {
            $documentAttributes[$i] = trim($this->excelData->raw($j,$i+$startColumn,$useSheet));
          }
          else // not the date column, process normally
          {
            $documentAttributes[$i] = trim($this->excelData->value($j,$i+$startColumn,$useSheet));
          }
        }
        
        if($documentAttributes[1] != "") //check whether a code is defined
        {
          // create unique document title using document code as prefix
          $documentTitle = $documentAttributes[1]."-".$documentTitle;
        }
        
        $this->documents[$documentTitle] = $documentAttributes;
      }
    }
  }
  
  public function save()
  {
    $identifiers = array();
    
    foreach($this->documents as $name => $attributes)
    {
      $document = new Document();
      $document->set('name', $name);
      $document->set('code', $attributes[1]);
      
      $adoptiondateFormatted = $this->createDate($attributes[2]);
      if(is_null($adoptiondateFormatted))
      {
        $document->set('adoption_date', "1945-10-24");
      }
      else
      {
        $document->set('adoption_date', $this->createDate($attributes[2]));
      }
      
      $document->set('organisation_id',
        Doctrine::getTable('Organisation')
          ->retrieveOrganisationIdByOrganisationNames(
          array($attributes[7], //Sub Organ
            $attributes[5], //Main Organ
            $attributes[3]  //Organisation
          )
        )
      );
      
      $document->set('documenttype_id',
        Doctrine::getTable('DocumentType')
          ->retrieveDocumentTypeIdByName($attributes[9])
      );
    
      $document->save();
      
      $identifiers[] = $document->get('document_id');
    }
    
    //return $identifiers;
  }
  
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