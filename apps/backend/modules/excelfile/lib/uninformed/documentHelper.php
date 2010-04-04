<?php
class DocumentHelper
{
  public function retrieveOrganisation($name)
  {
    $organisation = Doctrine::getTable('Organisation')->retrieveOrganisationIdByName($name);
  
    if($organisation != NULL)
    {
      return $organisation;
    }
    else
    {
      $organisation = new Organisation();  
      $organisation->set('name', $name);
      $organisation->save();
      
      return $organisation->get('id');
    }
  }
  
  public function retrieveDocumentType($name, $legalValue)
  {
	  //$documentType = Doctrine::getTable('DocumentType')->retrieveDocumentTypeIdByName($name);
	  
	  $q = Doctrine_Query::create()
    ->select('dt.id, dt.legalvalue_id')
    ->from('DocumentType dt');

    $documentType = $q->fetchOne();
	
    if($documentType != false)
    {
    	if($legalValue == $documentType['legalvalue_id'])
    	{
    		return $documentType['id'];
    	}
    	//else
    }
    //else
    
    $documentType = new DocumentType();  
    $documentType->set('name', $name);
    $documentType->set('legalvalue_id', $legalValue);
    $documentType->save();
      
    return $documentType->get('id');
  }
  
  public function retrieveLegalValue($name)
  {
    $legalValue = Doctrine::getTable('LegalValue')->retrieveLegalValueIdByName($name);

    if($legalValue != NULL)
    {
    	return $legalValue;
    }
    else
    {
    	$legalValue = new LegalValue();  
	    $legalValue->set('name', $name);
	    $legalValue->save();
	    
	    return $legalValue->get('id');
    }
  }
}