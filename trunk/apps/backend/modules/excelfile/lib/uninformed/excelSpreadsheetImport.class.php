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
  	
//  	clause tags
    foreach($documents as &$document)
    {
    	foreach($document['clauses'] as &$clause)
    	{
    		$clauseBody = new ClauseBody();
    		
    		$clauseBody->set('content', $clause[29]);
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
    		
    		$clause = $clauseBody->get('id');
    	}
    }
//  	
//  	clause bodys
//  	
//  	clauses
//  	
//  	document tags
//  	
//  	documents
  }
}