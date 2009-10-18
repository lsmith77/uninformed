<?php
/**
 * This class handles the import of data from a given Excel file.
 * The columns of the Excel and its type of information is hard coded
 * in this class. It is used only for un-informed documents.
 * 
 * @author Dennis Riedel <riedel.dennis@gmail.com>
 *
 */
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
    $this->subTagsByClause = array();
    $this->addresseesByClause = array();
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
    
    $clauseStartColumn = 18;
    $countClauseAttrColumns = 7; //No. of Excel columns used for clause attributes
    
    $addresseeStartColumn = 25;
    $countAddresseeAttrColumns = 4; //No. of Excel columns used for addressee attributes
    
    $subTagStartColumn = 30;
    $countSubTagAttrColumns = 10; //No. of Excel columns used for sub tag attributes
    
    /*
     * The following code extracts all documents from the Excel.
     * The document name is used as key in an assoc array.
     * Therefore the multiple lines of one document due to the different
     * clauses result in one document entry because the value part gets
     * overridden in the for loop. Maybe there is a better way
     * 
     */
    $documentTitle = "";
    $documentAttributes = array(); //will contain document columns
    $documentIdentifiers = array(); //will contain ids of saved documents
    
    $clauseName = "";
    $clauseAttributes = array(); //will contain clause columns
    
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
          //$tags[0] = $clauseName;
          
          for($k = 0; $k < $countClauseAttrColumns; $k++)
          {
            $clauseAttributes[$k+1] = trim($this->excelData->value($j, $clauseStartColumn + $k,$useSheet));
          }
          
          /**
           * TODO Refactor next to loops
           * @var unknown_type
           */
          $tags = array(); //will contain a row of subtags
          for($m = 0; $m < $countSubTagAttrColumns; $m++)
          {
            $subTag = trim($this->excelData->value($j, $subTagStartColumn + $m,$useSheet));
            
            if($subTag != "")
            {
              $tags[] = $subTag;
            }
          }
          
          $addressees = array(); //will contain a row of addressees
          for($n = 0; $n < $countAddresseeAttrColumns; $n++)
          {
            $addressee = trim($this->excelData->value($j, $addresseeStartColumn + $n,$useSheet));
            
            if($addressee != "")
            {
              $addressees[] = $addressee;
            }
          }
          
          $clauseIdentifier = $this->saveClauseInTable($clauseAttributes);
          $this->subTagsByClause[$clauseIdentifier] = $tags;
          $this->addresseesByClause[$clauseIdentifier] = $addressees;
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
    $this->saveTagsInTable();
    $this->saveAddresseesInTable();
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
      
      $document->set('documentURL', $attributes[15]);
    
      $document->save();
    }
  }
  
  /**
   * Creates a new Clause object from clauseAttributes array
   * Returns clause identifier.
   */
  private function saveClauseInTable($clauseAttributesArray)
  {
    $clause = new Clause();
    $clause->set('name', $clauseAttributesArray[0]);
    $clause->set('clause_number', $clauseAttributesArray[2]);
    $clause->set('content', $clauseAttributesArray[1]);
    
    $clause->set('information_type',
      Doctrine::getTable('ClauseInformationType')
        ->retrieveClauseInformationTypeIdByLabel($clauseAttributesArray[4])
    );
    
    $clause->set('operative_phrase',
      Doctrine::getTable('ClauseOperativePhrase')
        ->retrieveClauseOperativePhraseIdByLabel($clauseAttributesArray[3])
    );
    
    $clause->save();
    
    return $clause->get('clause_id');
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
   * This function saves subTags retrieved from the Excel document in the
   * Tag table. To avoid duplicates, it first gets a list of all tag names
   * from the tag table.
   * 
   * To save the tags with their corresponding clauses later, we save the tag
   * identifiers in an assoc array, for each clause ID the correspondig tag IDs.
   * 
   * If a tag already exists in the table Tag, we retrieve its ID. If it does
   * not exist, we create it and afterwards retrieve its ID.
   * 
   * Finally, we call the function to save the relationships between tag and clause.
   * 
   * @return none
   */
  private function saveTagsInTable()
  {
    $newTagsAvailable = false;
    $tagIdentifiers = array();
    
    //Retrieve list of existing tags
    $tags = Doctrine::getTable('Tag')->getAllTagNames();
    
    foreach($this->subTagsByClause as $clauseId => $subTags)
    {
      $tagIdentifiers[$clauseId] = array();
      
      foreach($subTags as $subTag)
      {
        if($newTagsAvailable)
        {
          //Retrieve list of existing tags
          $tags = Doctrine::getTable('Tag')->getAllTagNames();
        }
        
        $foundTagInList = false;
        
        foreach($tags as $tag)
        {
          // compare existing Tags with Tag from Excel, case insensitive
          if(strCaseCmp($subTag,$tag['name']) == 0)
          {
            $tagIdentifiers[$clauseId][] = $tag['tag_id'];
            $newTagsAvailable = false;
            
            $foundTagInList = true;
            
            break;
          }
          else
          {
            // pass $foundTagInList = false;
          }
        }
        
        /*
         * If we cannot find the tag in the Tag table, we creat a new
         * item in the table with the name and an empty tag_type.
         */
        if(!$foundTagInList)
        {
          $tag = new Tag();
          
          $tag->set('name', $subTag);
          $tag->set('tag_type', '');
          
          $tag->save();
          
          $tagIdentifiers[$clauseId][] = $tag->get('tag_id');
          
          $newTagsAvailable = true;
        }
      }
    }
    
    $this->linkClausesWithTags($tagIdentifiers);
  }
  
  /**
   * The function instantiates an object of type ClauseTag and saves
   * the relationship between a Clause and its (sub)Tags using their IDs.
   * 
   * @param array $clauseTagIdentifiers
   * @return none
   */
  private function linkClausesWithTags($clauseTagIdentifiers)
  {
    foreach($clauseTagIdentifiers as $clauseId => $tagIds)
    {
      foreach($tagIds as $tagId)
      {
        $clauseTag = new ClauseTag();
        
        $clauseTag->set('clause_id', $clauseId);
        $clauseTag->set('tag_id', $tagId);
        
        $clauseTag->save();
      }
    }
  }
  
  /**
   * This function saves addressees retrieved from the Excel document in the
   * Addressee table. To avoid duplicates, it first gets a list of all addressee
   * names from the adressee table.
   * 
   * To save the addressees with their corresponding clauses later, we save the addressee
   * identifiers in an assoc array, for each clause ID the correspondig addressee IDs.
   * 
   * If a addressee already exists in the table addressee, we retrieve its ID. If it does
   * not exist, we create it and afterwards retrieve its ID.
   * 
   * Finally, we call the function to save the relationships between addressee and clause.
   * 
   * @return none
   */
  private function saveAddresseesInTable()
  {
    $newAddresseesAvailable = false;
    $clauseAddresseeIdentifiers = array();
    
    //Retrieve list of existing as
    $addresseesFromTable = Doctrine::getTable('Addressee')->getAllAddresseeNames();
    
    foreach($this->addresseesByClause as $clauseId => $addresseesFromExcel)
    {
      $clauseAddresseeIdentifiers[$clauseId] = array();
      
      foreach($addresseesFromExcel as $oneAddresseeFromExcel)
      {
        if($newAddresseesAvailable)
        {
          //Retrieve list of existing tags
          $addresseesFromTable = Doctrine::getTable('Addressee')->getAllAddresseeNames();
        }
        
        $foundAddresseeInList = false;
        
        foreach($addresseesFromTable as $oneAddresseeFromTable)
        {
          // compare existing Addressees with Addressee from Excel, case insensitive
          if(strCaseCmp($oneAddresseeFromExcel,$oneAddresseeFromTable['name']) == 0)
          {
            $clauseAddresseeIdentifiers[$clauseId][] = $oneAddresseeFromTable['id'];
            $newAddresseesAvailable = false;
            
            $foundAddresseeInList = true;
            
            break;
          }
          else
          {
            // pass $foundAddresseeInList = false;
          }
        }
        
        /*
         * If we cannot find the addressee in the Addressee table, we creat a new
         * item in the table with the name.
         */
        if(!$foundAddresseeInList)
        {
          $addressee = new Addressee();
          
          $addressee->set('name', $oneAddresseeFromExcel);
          
          $addressee->save();
          
          $clauseAddresseeIdentifiers[$clauseId][] = $addressee->get('id');
          
          $newAddresseesAvailable = true;
        }
      }
    }
    
    $this->linkClausesWithAddressees($clauseAddresseeIdentifiers);
  }
  
  /**
   * The function instantiates an object of type ClauseAddressee and saves
   * the relationship between a Clause and its Addressees using their IDs.
   * 
   * @param array $clauseAddresseeIdentifiers
   * @return none
   */
  private function linkClausesWithAddressees($clauseAddresseeIdentifiers)
  {
    foreach($clauseAddresseeIdentifiers as $clauseId => $addresseeIds)
    {
      foreach($addresseeIds as $addresseeId)
      {
        $clauseAddressee = new ClauseAddressee();
        
        $clauseAddressee->set('clause_id', $clauseId);
        $clauseAddressee->set('addressee_id', $addresseeId);
        
        $clauseAddressee->save();
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
      $oneDayInSeconds = 24 * 60 * 60; //hours * minutes * seconds
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