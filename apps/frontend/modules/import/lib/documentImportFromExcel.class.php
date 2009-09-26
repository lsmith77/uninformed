<?php
class documentImportFromExcel
{
  var $excelFile;
  var $excelData;
  var $documents; //will contain all documents and their attributes
  var $clauses; //will contain all clauses and their attributes
  var $subTags; //will contain all subtags
  
  /**
   * Constructor
   * 
   * @param $excelFile
   */
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
    $this->clauses = array();
    $this->subTags = array();
  }
  
  /**
   * Retrieves document and clause information from the excel data structure and
   * saves it in arrays for documents and for clauses.
   * 
   * @return unknown_type
   */
  public function process()
  {
    $useSheet = 0;
    $startRow = 1;
    $startColumn = 2;
    
    $countDocAttrColumns = 16; //No. of Excel columns used for UN document attributes
    $countClauseAttrColumns = 12; //No. of Excel columns used for clause attributes
    $countSubTagAttrColumns = 10; //No. of Excel columns used for sub tag attributes
    
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
    
    $clauseName = "";
    $clauseAttributes = array(); //will contain clause columns
    $subTags = array(); //will contain a row of subtags
    
    $amountOfUsedRows = $this->excelData->rowcount($useSheet);
    
    for($j = $startRow + 1; $j <= $amountOfUsedRows; $j++)
    {
      $documentTitle = trim($this->excelData->value($j,$startColumn,$useSheet));
      $clauseName = ""; //reset clause name
      
      if($documentTitle != "") //document name is obligatory
      {
        for($i = 1; $i <= $countDocAttrColumns; $i++)
        {
          if($i == 2) //check whether actual column is the date column
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
          $clauseName = $documentAttributes[1];
        }
        
        $this->documents[$documentTitle] = $documentAttributes;
        
        if($clauseName != "")
        {
          $clauseAttributes[0] = $clauseName;
          $subTags[0] = $clauseName;
          
          for($k = 1; $k <= $countClauseAttrColumns; $k++)
          {
            $clauseAttributes[$k] = trim($this->excelData->value($j,($k-1)+$startColumn+$countDocAttrColumns,$useSheet));
          }
          
          for($m = 1; $m <=$countSubTagAttrColumns; $m++)
          {
            $subTag = trim($this->excelData->value($j,($m-1)+$startColumn+$countDocAttrColumns+$countClauseAttrColumns,$useSheet));
            
            if($subTag != "")
            {
              $subTags[$m] = trim($this->excelData->value($j,($m-1)+$startColumn+$countDocAttrColumns+$countClauseAttrColumns,$useSheet));
            }
          }
          
          $this->clauses[] = $clauseAttributes;
          $this->subTags[] = $subTags;
        }
      }
    }
  }
  
  /**
   * Calls functions to save data from arrays into the database
   */
  public function save()
  {
    $this->saveDocumentsInTable();
    $this->saveClausesInTable();
    $this->linkClausesWithDocuments();
  }
  
  /**
   * For each document in the array it creates an object and saves it in the
   * database.
   * 
   */
  private function saveDocumentsInTable()
  {
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
        $document->set('adoption_date', $adoptiondateFormatted);
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
    }
  }
  
  /**
   * For each clause in the array it creates an object and saves it in the
   * database.
   */
  private function saveClausesInTable()
  {
    foreach($this->clauses as $clauseItem)
    {
      $clause = new Clause();
      $clause->set('name', $clauseItem[0]);
      $clause->set('clause_number', $clauseItem[2]);
      $clause->set('content', $clauseItem[1]);
      
      $clause->set('information_type',
        Doctrine::getTable('ClauseInformationType')
          ->retrieveClauseInformationTypeIdByLabel($clauseItem[4])
      );
      
      $clause->set('operative_phrase',
        Doctrine::getTable('ClauseOperativePhrase')
          ->retrieveClauseOperativePhraseIdByLabel($clauseItem[3])
      );
      
      $clause->set('addressee',
        Doctrine::getTable('Addressee')
          ->retrieveAddresseeIdByLabel($clauseItem[8])
      );
      
      $clause->save();
    }
  }
  
  /**
   * Updates clauses adding the correct document id. Matched through
   * document code which was used as clause name.
   * 
   */
  private function linkClausesWithDocuments()
  {
    $clauses = Doctrine::getTable('Clause')->getAllClauses();
    $documents = Doctrine::getTable('Document')->getAllDocuments();
    
    foreach($clauses as $clauseItem)
    {
      foreach($documents as $documentItem)
      {
        if($clauseItem['name'] == $documentItem['code'])
        {
          $clause = Doctrine::getTable('Clause')->find($clauseItem['clause_id']);
          $clause->set('document_id', $documentItem['document_id']);
          
          $clause->save();
        }
      }
    }
  }
  
  /**
   * Receives an excel date number (days since 1-1-1900).
   * Converts it into a timestamp which then is converted into
   * a date string of format Y-m-d.
   * Returns NULL when date number is not valid.
   * 
   * @param $dateInteger
   * @return unknown_type
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