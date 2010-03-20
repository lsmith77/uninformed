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
  
  /**
   * Applies the document attribute to a given query retrieving addressees.
   *
   * @param Doctrine_Query $query - query to have clause attribute applied.
   * @param Integer $value - Clause ID
   */
  static public function applyDocumentFilter($query, $value)
  {
  	
    /* TODO: Return set of addressees related to chosen document
    $rootAlias = $query->getRootAlias();
    switch ($value)
    {
      case '0':
        $query->where($rootAlias.'.quantity > '
          .$rootAlias.'.quantity_alarm');
        break;
      case '1':
        $query->where($rootAlias.'.quantity <= '
          .$rootAlias.'.quantity_alarm');
        break;
    }
    return $query;
    */
  }
}
