<?php

class ClauseInformationTypeTable extends Doctrine_Table
{
  public function getAllClauseInformationTypes()
  {
    $q = $this->createQuery('j');
    return $q->fetchArray();
  }
  
  public function getAllClauseInformationTypeNames()
  {
    $q = $this->createQuery('t')
      ->select('t.name');
      
     return $q->fetchArray();
  }
  
  public function retrieveClauseInformationTypeIdByName($typeName)
  {
    $types = $this->getAllClauseInformationTypes();
    
    foreach($types as $type)
    {
      //case insensitive comparison
      $compareResult = strcasecmp($typeName, $type['name']);
      if($compareResult == 0)
      {
        return $type['id'];
      }
    }
    
    return NULL;
  }
}
