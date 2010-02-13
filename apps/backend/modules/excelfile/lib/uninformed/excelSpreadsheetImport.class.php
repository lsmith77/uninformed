<?php
class excelSpreadsheetImport
{ 
  private $excelData = NULL;
  private $excelStructure = NULL;
  
  private static $SHEET = 0;
  
  private static $AMOUNT_DOCUMENTCOLUMNS = 27;
  private static $AMOUNT_CLAUSECOLUMNS = 23;
  
  private static $FIRST_DOCUMENTCOLUMN = 2;
  private static $FIRST_CLAUSECOLUMN = 29;
  
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
  	$followups = array();
    
  	$title = "";
  	$code = "";
  	$followup = "";
  	
    for($i = self::$FIRST_ROW; $i <= $countRows; $i++) //rows
    {
    	$data = array();
    	
    	for($j = self::$FIRST_DOCUMENTCOLUMN; $j < self::$AMOUNT_DOCUMENTCOLUMNS + 1; $j++) //columns
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
    
    return $documents;
  }
  
  public function saveData()
  {
//  	save data in database
  }
}