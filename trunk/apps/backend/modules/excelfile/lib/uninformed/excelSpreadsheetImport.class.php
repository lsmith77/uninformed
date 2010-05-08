<?php
class excelSpreadsheetImport
{ 
  private $excelData = NULL;
  
  private static $SHEET = 0;
  private static $FIRST_ROW = 2;
  
  private static $FIRST_DOCUMENTCOLUMN = 1;
  private static $FIRST_CLAUSECOLUMN = 29;
  
  private static $AMOUNT_DOCUMENTCOLUMNS = 27;
  private static $AMOUNT_CLAUSECOLUMNS = 23;
  
  private static $AMOUNT_DOCUMENTTAGCOLUMNS = 11;
  private static $AMOUNT_CLAUSETAGCOLUMNS = 10;
  
  private static $FIRST_DOCUMENTTAGCOLUMN = 18;
  private static $FIRST_CLAUSETAGCOLUMN = 42;
  
  private static $FIRST_ADDRESSEECOLUMN = 37;
  private static $AMOUNT_ADDRESSEECOLUMNS = 4;
  
  /*
   * Document and clause columns positions
   */
  private static $POS_DOCUMENT_ID = 1;
  private static $POS_DOCUMENT_TITLE = 2;
  private static $POS_DOCUMENT_CODE = 3;
  private static $POS_DOCUMENT_FOLLOWUP = 13;
  private static $POS_DOCUMENT_ADOPTIONDATE = 4;
  
  private static $POS_DOCUMENT_ORGANISATION = 5;
  private static $POS_DOCUMENT_ORGANISATION_NEW = 6;
  private static $POS_DOCUMENT_MAINORGAN = 7;
  private static $POS_DOCUMENT_MAINORGAN_NEW = 8;
  private static $POS_DOCUMENT_SUBORGAN = 9;
  
  private static $POS_DOCUMENT_LEGALVALUE = 10;
  private static $POS_DOCUMENT_DOCUMENTTYPE = 11;
  private static $POS_DOCUMENT_VOTE = 15;
  private static $POS_DOCUMENT_VOTE_URL = 16;
  private static $POS_DOCUMENT_URL = 17;
  
  private static $POS_CLAUSE_CONTENT = 29;
  private static $POS_CLAUSE_NUMBER = 30;
  private static $POS_CLAUSE_OPERATIVEPHRASE = 31;
  private static $POS_CLAUSE_INFORMATIONTYPE = 32;
  private static $POS_CLAUSE_PARENTNUMBER = 35;

  public function __construct() {}
  
  public function loadDataFromFile($file)
  {
  	$this->excelData = new spreadsheetExcelReader($file);
  	
  	$countRows = $this->excelData->rowcount(self::$SHEET);
  	
  	$documents = array();
  	
    for($i = self::$FIRST_ROW; $i <= $countRows; $i++) //rows
    {
      $title = "";
      $code = "";
      $date = "";
      $followup = "";
      $tags = array();
      $data = array();
      
      $emptyRow = false;
    	
      for($j = self::$FIRST_DOCUMENTCOLUMN; $j < self::$FIRST_DOCUMENTCOLUMN + self::$AMOUNT_DOCUMENTCOLUMNS; $j++) //columns
      {
      	$value = "";
      	
        if($j == self::$POS_DOCUMENT_ADOPTIONDATE) { //excel date format data, adoption date column
          $value = trim($this->excelData->raw($i, $j,self::$SHEET));
          /*
          if($value == "") // do not import documents without adoption date
          {
            $emptyRow = true;
          }*/
          
          $date = $value;
        } else {
          $value = trim($this->excelData->value($i, $j,self::$SHEET));
        }
        
        if($j == self::$POS_DOCUMENT_TITLE) {
        	if($value == "")
        	{
        		$emptyRow = true;
        	}
        	
        	$title = $value;
        } else if($j == self::$POS_DOCUMENT_CODE) {
          $code = $value;
        } else if($j == self::$POS_DOCUMENT_FOLLOWUP) {
          $followup = $value;
        } else if($j >= self::$FIRST_DOCUMENTTAGCOLUMN
          && $j < self::$FIRST_DOCUMENTTAGCOLUMN + self::$AMOUNT_DOCUMENTTAGCOLUMNS)
        {
          $tags[] = $value;
        } else {
          $data[$j] = $value;
        }
      }

      if(!$emptyRow)
      {
      	
      	$title = $title."#".$date;
      	
	      if(!isset($documents[$title])) {
	      	$documents[$title] = array();
	        $documents[$title]['countClauses'] = 1;
	      } else {
	        $documents[$title]['countClauses']++;
	      }
	
        if(!isset($documents[$title]['adoption_date'])) {
          $documents[$title]['adoption_date'] = $date;
        }
	      
	      if(!isset($documents[$title]['code'])) {
	        $documents[$title]['code'] = $code;
	      }
	    
	      if(!isset($documents[$title]['followup'])) {
	        $documents[$title]['followup'] = $followup;
	      }
	    
	      if(!isset($documents[$title]['tags'])) {
	        $documents[$title]['tags'] = $tags;
	      } else {
	        $documents[$title]['tags'] = array_merge($documents[$title]['tags'], $tags);
	      }
	
	      $documents[$title]['data'] = $data;
      }
      else
      {
      	//reset for next loop iteration
      	$emptyRow = false;
      }
    }
    
    //add clause data
    $documentClauses_firstRow = self::$FIRST_ROW;
    
    foreach($documents as &$document)
    {
  	  $clauses = array();
      $rowcount = 0;
    	
      do
      {
        $clause = array();
    		
        for($n = self::$FIRST_CLAUSECOLUMN; $n < self::$FIRST_CLAUSECOLUMN + self::$AMOUNT_CLAUSECOLUMNS; $n++)
        {
          $clause[$n] = trim($this->excelData->value($documentClauses_firstRow + $rowcount, $n, self::$SHEET));
        }
    		
        $clauses[] = $clause;
        $rowcount++;
      } while($rowcount < $document['countClauses']);
    	
      $document['clauses'] = $clauses;
    	
      $documentClauses_firstRow+= $document['countClauses'];
    }
    
    return $documents;
  }
  
//  	save data in database
  public function saveData($excelFileId, &$documents)
  {
    $importuser = new sfGuardUser();
    $importuser->username = $importuser->email_address = 'import-'.(string)microtime(true);
    $importuser->is_active = false;
    $importuser->is_super_admin = false;
    $importuser->excel_file_id = $excelFileId;
    $importuser->save();

    $context = sfContext::getInstance();
    if ($context) {
        $user = $context->getUser();
        if ($user) {
            $user->setFlash('blame_id', $importuser);
        }
    }
    if (empty($user)) {
        throw new Exception('Could not get current user');
    }

    $clauseHelper = new ClauseHelper();
    $documentHelper = new DocumentHelper();
  	
    foreach($documents as $documentName => &$document)
    {
      foreach($document['clauses'] as &$clause)
      {
        $clauseBody = new ClauseBody();

        $clauseNumber = "";

        $clauseBody->set('content', $clause[self::$POS_CLAUSE_CONTENT]);

        $clauseNumber = $clause[self::$POS_CLAUSE_NUMBER];
        $clauseParentNumber = $clause[self::$POS_CLAUSE_PARENTNUMBER];

        $clauseBody->set('operative_phrase_id', $clauseHelper->retrieveClauseOperativePhrase($clause[self::$POS_CLAUSE_OPERATIVEPHRASE])); //operative phrase
        $clauseBody->set('information_type_id', $clauseHelper->retrieveClauseInformationType($clause[self::$POS_CLAUSE_INFORMATIONTYPE])); //information type

        // Save tags of clause
        $tags = array();
        for($a = self::$FIRST_CLAUSETAGCOLUMN; $a < self::$FIRST_CLAUSETAGCOLUMN + self::$AMOUNT_CLAUSETAGCOLUMNS; $a++)
        {
          if($clause[$a] != "") {
            $tags[] = strtolower($clause[$a]);
          }
        }

        $tags = array_unique($tags);
        $clauseBody->setTags($tags);

        $clauseBody->save();

        //addressees
        for($i = self::$FIRST_ADDRESSEECOLUMN; $i < self::$FIRST_ADDRESSEECOLUMN + self::$AMOUNT_ADDRESSEECOLUMNS; $i++)
        {
          if($clause[$i] != "")
          {
            $addressee = $clauseHelper->retrieveAddressee($clause[$i]);

            if($addressee != NULL)
            {
              $clauseAddressee = new ClauseAddressee();

              $clauseAddressee->clause_body_id = $clauseBody->get('id');
              $clauseAddressee->addressee_id = $addressee;

              $clauseAddressee->save();
            }
          }
        }

        //last: overwrite clause value with body id and number for later referencing
        $clause = array($clauseBody->get('id') => array($clauseNumber, $clauseParentNumber));
      }

      /**
       * DOCUMENTS
       * 
       */
      
      $newDocument = new Document();

      $newDocument->set('name', $documentName);
      $newDocument->set('code', $document['code']);
      $newDocument->set('adoption_date', $this->createDate($document['adoption_date']));
      
      $organisationFields = array();
      
      $organisationFields[] = $document['data'][self::$POS_DOCUMENT_SUBORGAN];
      $organisationFields[] = $document['data'][self::$POS_DOCUMENT_MAINORGAN_NEW];
      $organisationFields[] = $document['data'][self::$POS_DOCUMENT_MAINORGAN];
      $organisationFields[] = $document['data'][self::$POS_DOCUMENT_ORGANISATION_NEW];
      $organisationFields[] = $document['data'][self::$POS_DOCUMENT_ORGANISATION];

      $newDocument->set('organisation_id', $documentHelper->retrieveIssuingOrganisation($organisationFields));
      
      $newDocument->set('documenttype_id', $documentHelper
        ->retrieveDocumentType(
          $document['data'][self::$POS_DOCUMENT_DOCUMENTTYPE],
          $documentHelper->retrieveLegalValue($document['data'][self::$POS_DOCUMENT_LEGALVALUE])
        )); //document type
      $newDocument->set('vote_url', $document['data'][self::$POS_DOCUMENT_VOTE_URL]);
      $newDocument->set('document_url', $document['data'][self::$POS_DOCUMENT_URL]);

      // Save tags of document
      $tags = array();

      foreach($document['tags'] as $name)
      {
        if($name != "") {
          $tags[] = strtolower($name);
        }
      }

      //$tags = array_unique($tags);
      $tags = array_merge(array_flip(array_flip($tags)));
      $newDocument->setTags($tags);
      
      $newDocument->save();
    	
      $document['id'] = $newDocument->get('id');
      
      $documentHelper->saveVotesForDocument(
        $document['id'],
        $document['data'][self::$POS_DOCUMENT_LEGALVALUE],
        $document['data'][self::$POS_DOCUMENT_VOTE]);
    }

    // find and save document parent relations
    foreach($documents as $documentA)
    {
      foreach($documents as $documentB)
      {
        $compareResult = strcasecmp($documentA['code'], $documentB['followup']);
        if($compareResult == 0 && $documentA['code'] != "")
        {
          // Document B is parent of Document A
          $child = Doctrine_Core::getTable('Document')->find($documentA['id']);
          $child->set('parent_document_id', $documentB['id']);
          $child->save();

          // Clause Body Relations
          foreach($documentA['clauses'] as $keyA => $clauseOfA)
          {
            foreach($documentB['clauses'] as $keyB => $clauseOfB)
            {
              $id_a = key($clauseOfA);
              $id_b = key($clauseOfB);

              if($clauseOfA[$id_a][1] == $clauseOfB[$id_b][0]
                && $clauseOfA[$id_a][1] != ""
                && $clauseOfB[$id_b][0] != ""
              ) {
                // Clause Body B is parent of Clause Body A
                $child = Doctrine_Core::getTable('ClauseBody')->find($id_a);
                $child->set('parent_clause_body_id', $id_b);
                $child->save();
              }
            }
          }
        }
      }
    }
    
    //save clause body document relation in Clause Table
    foreach($documents as $documentBody)
    {
      foreach($documentBody['clauses'] as $key => $clauseItem)
      {
        $clauseBodyId = key($clauseItem);

        $newClause = new Clause();
              
        $newClause->clause_body_id = $clauseBodyId;
        $newClause->document_id = $documentBody['id'];
              
        $newClause->save();
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
    return null;
  }
}