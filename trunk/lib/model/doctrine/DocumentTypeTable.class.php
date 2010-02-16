<?php

class DocumentTypeTable extends Doctrine_Table
{
  public function getAllDocumentTypes()
  {
    $q = $this->createQuery('j');
    return $q->fetchArray();
  }
  
  public function getAllDocumentTypeNames()
  {
    $q = $this->createQuery('t')
      ->select('t.name');
      
     return $q->fetchArray();
  }
  
  public function retrieveDocumentTypeIdByName($documentTypeName)
  {
    $documentTypes = $this->getAllDocumentTypes();
    
    foreach($documentTypes as $documentType)
    {
      //case insensitive comparison
      $compareResult = strcasecmp($documentTypeName, $documentType['name']);
      if($compareResult == 0)
      {
        return $documentType['id'];
      }
    }
    
    return NULL;
  }
}
