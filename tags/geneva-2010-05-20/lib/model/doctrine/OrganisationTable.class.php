<?php

class OrganisationTable extends Doctrine_Table
{
  public function getAllOrganisations()
  {
    $q = $this->createQuery('j');
    return $q->fetchArray();
  }
  
  public function getAllOrganisationNames()
  {
    $q = $this->createQuery('t')
      ->select('t.name');
      
     return $q->fetchArray();
  }
  
  public function retrieveOrganisationIdByName($organisationName)
  {
    $organisations = $this->getAllOrganisations();
    
    foreach($organisations as $organisation)
    {
      //case insensitive comparison
      $compareResult = strcasecmp($organisationName, $organisation['name']);
      if($compareResult == 0)
      {
        return $organisation['id'];
      }
    }
    
    return NULL;
  }
}
