<?php
class excelSpreadsheetImport
{ 
  private $excelData = NULL;
  
  private static $SHEET = 0;
  
  private static $AMOUNT_DOCUMENTCOLUMNS = 27;
  private static $AMOUNT_CLAUSECOLUMNS = 23;
  
  private static $FIRST_DOCUMENTCOLUMN = 2;
  private static $FIRST_CLAUSECOLUMN = 29;
  
  private static $AMOUNT_DOCUMENTTAGCOLUMNS = 11;
  private static $AMOUNT_CLAUSETAGCOLUMNS = 10;
  
  private static $FIRST_DOCUMENTTAGCOLUMN = 18;
  private static $FIRST_CLAUSETAGCOLUMN = 42;
  
  private static $FIRST_ROW = 2;
  
  private static $COLUMN_DOCUMENTTITLE = 2;
  private static $COLUMN_DOCUMENTCODE = 3;
  private static $COLUMN_DOCUMENTFOLLOWUP = 13;
  
  private static $FIRST_ADDRESSEECOLUMN = 37;
  private static $AMOUNT_ADDRESSEECOLUMNS = 4;
  
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
      $followup = "";
    	$data = array();
    	
    	for($j = self::$FIRST_DOCUMENTCOLUMN; $j < self::$FIRST_DOCUMENTCOLUMN + self::$AMOUNT_DOCUMENTCOLUMNS; $j++) //columns
    	{
    		if($j == 4) //excel date format data, adoption date column
    		  $value = trim($this->excelData->raw($i,$j,self::$SHEET));
    		else
    		  $value = trim($this->excelData->value($i,$j,self::$SHEET));
    		
    		if($j == self::$COLUMN_DOCUMENTTITLE)
    		  $title = $value;
    		else if($j == self::$COLUMN_DOCUMENTCODE)
          $code = $value;
        else if($j == self::$COLUMN_DOCUMENTFOLLOWUP)
          $followup = $value;
    		else  
    		  $data[$j] = $value;
    	}
    	
    	if(!isset($documents[$title]))
        $documents[$title]['countClauses'] = 1;
      else
        $documents[$title]['countClauses']++;
        
      if(!isset($documents[$title]['code']))
        $documents[$title]['code'] = $code;
        
      if(!isset($documents[$title]['followup']))
        $documents[$title]['followup'] = $followup;
        
      $documents[$title]['data'] = $data;
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
          $clause[$n] = trim($this->excelData->value($documentClauses_firstRow + $rowcount,$n,self::$SHEET));
        }
    		
        $clauses[] = $clause;
    		$rowcount++;
    	}while($rowcount < $document['countClauses']);
    	
    	$document['clauses'] = $clauses;
    	
    	$documentClauses_firstRow = $documentClauses_firstRow + $document['countClauses'];
    }
    
    return $documents;
  }
  
  public function saveData(&$documents)
  {
//  	save data in database

  	$clauseHelper = new ClauseHelper();
  	
    foreach($documents as $documentName => &$document)
    {
    	foreach($document['clauses'] as &$clause)
    	{
    		$clauseBody = new ClauseBody();
    		
    		$clauseNumber = "";
    		
    		$clauseBody->set('content', $clause[29]);
    		
    		$clauseNumber = $clause[30];
    		$clauseParentNumber = $clause[35];
    		
    		$clauseBody->set('operative_phrase_id', $clauseHelper->retrieveClauseOperativePhrase($clause[31])); //operative phrase
    		$clauseBody->set('information_type_id', $clauseHelper->retrieveClauseInformationType($clause[32])); //information type
        
    		$arr_clause_tags = array_slice($clause, self::$FIRST_CLAUSETAGCOLUMN, self::$AMOUNT_CLAUSETAGCOLUMNS);
    		$tags = array();
    		foreach($arr_clause_tags as $name)
        {
          if($name != "")
        	  $tags[] = $name;
        }
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
    		$clause = array($clauseBody->get('id') => array($clauseNumber,$clauseParentNumber));
    	}
    	
    	$documentHelper = new DocumentHelper();
    	
    	$newDocument = new Document();
    	
    	$newDocument->set('name', $documentName);
    	$newDocument->set('code', $document['code']);
    	$newDocument->set('adoption_date', $this->createDate($document['data'][4]));
    	$newDocument->set('organisation_id', $documentHelper->retrieveOrganisation($document['data'][5])); //organisation
      $newDocument->set('documenttype_id', $documentHelper->retrieveDocumentType($document['data'][11])); //document type
    	$newDocument->set('document_url', $document['data'][17]);
      
    	$newDocument->save();
    	
    	$document['id'] = $newDocument->get('id');
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
          		
          		if($clauseOfA[$id_a][1] == $clauseOfB[$id_b][0] && $clauseOfA[$id_a][1] != "" && $clauseOfB[$id_b][0] != "")
          		{
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
    else
    {
      return NULL;
    }
  }
}