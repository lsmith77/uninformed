<?php

class DocumentTable extends Doctrine_Table
{
  public function getAllDocuments()
  {
    $q = $this->createQuery('j');
    return $q->fetchArray();
  }
  
  public function getAllDocumentNames()
  {
    $q = $this->createQuery('t')
      ->select('t.name');
      
     return $q->fetchArray();
  }
  
  public function retrieveDocumentIdByName($documentName)
  {
    $documents = $this->getAllDocuments();
    
    foreach($documents as $document)
    {
      //case insensitive comparison
      $compareResult = strcasecmp($documentName, $document['name']);
      if($compareResult == 0)
      {
        return $document['id'];
      }
    }
    
    return NULL;
  }
}
