<?php
class excelSpreadsheetImport
{ 
  private $excelData = NULL;
  
  public function __construct() {}
  
  public function loadDataFromFile($file)
  {
  	$this->excelData = new spreadsheetExcelReader($file);
  }
}