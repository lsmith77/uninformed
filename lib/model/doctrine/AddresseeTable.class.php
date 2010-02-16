<?php

class AddresseeTable extends Doctrine_Table
{
  public function getAllAddresees()
  {
    $q = $this->createQuery('j');
    return $q->fetchArray();
  }
  
  public function getAllAddresseeNames()
  {
    $q = $this->createQuery('t')
      ->select('t.name');
      
     return $q->fetchArray();
  }
  
  public function retrieveAdresseeIdByName($addresseeName)
  {
    $addressees = $this->getAllAddresees();
    
    foreach($addressees as $addressee)
    {
      //case insensitive comparison
      $compareResult = strcasecmp($addresseeName, $addressee['name']);
      if($compareResult == 0)
      {
        return $addressee['id'];
      }
    }
    
    return NULL;
  }
}
