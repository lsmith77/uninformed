<?php

class ClauseProcessTable extends Doctrine_Table
{
  public function getAllClauseProcesses()
  {
    $q = $this->createQuery('j');
    return $q->fetchArray();
  }
  
  public function getAllClauseProcessNames()
  {
    $q = $this->createQuery('t')
      ->select('t.name');
      
     return $q->fetchArray();
  }
  
  public function retrieveClauseProcessIdByName($processName)
  {
    $processes = $this->getAllClauseProcesses();
    
    foreach($processes as $process)
    {
      //case insensitive comparison
      $compareResult = strcasecmp($processName, $process['name']);
      if($compareResult == 0)
      {
        return $process['id'];
      }
    }
    
    return NULL;
  }
}
