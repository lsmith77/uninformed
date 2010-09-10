<?php

class ClauseOperativePhraseTable extends Doctrine_Table
{
  public function getAllClauseOperativePhrases()
  {
    $q = $this->createQuery('j');
    return $q->fetchArray();
  }
  
  public function getAllClauseOperativePhraseNames()
  {
    $q = $this->createQuery('t')
      ->select('t.name');
      
     return $q->fetchArray();
  }
  
  public function retrieveClauseOperativePhraseIdByName($phraseName)
  {
    $phrases = $this->getAllClauseOperativePhrases();
    
    foreach($phrases as $phrase)
    {
      //case insensitive comparison
      $compareResult = strcasecmp($phraseName, $phrase['name']);
      if($compareResult == 0)
      {
        return $phrase['id'];
      }
    }
    
    return NULL;
  }
}
