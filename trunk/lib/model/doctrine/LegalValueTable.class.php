<?php

class LegalValueTable extends Doctrine_Table
{
  public function getAllLegalValues()
  {
    $q = $this->createQuery('l');
    return $q->fetchArray();
  }
  
  public function getAllLegalValueNames()
  {
    $q = $this->createQuery('t')
      ->select('t.name');
      
     return $q->fetchArray();
  }
  
  public function retrieveLegalValueIdByName($legalValueName)
  {
    $legalValues = $this->getAllLegalValues();
    
    foreach($legalValues as $legalValue)
    {
      //case insensitive comparison
      $compareResult = strcasecmp($legalValueName, $legalValue['name']);
      if($compareResult == 0)
      {
        return $legalValue['id'];
      }
    }
    
    return NULL;
  }
}
