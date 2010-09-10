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
   * Applies the document to a given query retrieving addressees to be filtered.
   *
   * @param Doctrine_Query $query - query to have document attribute applied.
   * @param Integer $value - Document ID
   */
  static public function applyDocumentFilter($query, $value)
  {
    $rootAlias = $query->getRootAlias();

    $query->innerJoin($rootAlias.'.ClauseBodies cb')
      ->innerJoin('cb.Clause c')
      ->where('c.document_id = ?', $value);

    return $query;
  }
}
