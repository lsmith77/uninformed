<?php
class DocumentHelper
{
	/**
	 * [0] = Sub Organ
	 * [1] = Main Organ New
	 * [2] = Main Organ
	 * [3] = Organisation New
	 * [4] = Organisation
	 * 
	 * @param unknown_type $documentOrganisations
	 * @return unknown|mixed
	 */
	private $countries = array();
	
	function __construct()
	{
		//get the countries once at object initialization
		$this->countries = Doctrine::getTable('Country')->findAll();
	}
	
  public function retrieveIssuingOrganisation($documentOrganisations)
  {
  	$hierarchy = array();
  	
  	if($documentOrganisations[0] != "")
  	{
  		$hierarchy[] = $this->retrieveOrganisation($documentOrganisations[0]);
  	}
  	
  	if($documentOrganisations[1] != "")
  	{
  		$hierarchy[] = $this->retrieveOrganisation($documentOrganisations[1]);
  	}
  	
  	if($documentOrganisations[2] != "")
  	{
  		$hierarchy[] = $this->retrieveOrganisation($documentOrganisations[2]);
  	}
    
  	if($documentOrganisations[3] != "")
  	{
  		$hierarchy[] = $this->retrieveOrganisation($documentOrganisations[3]);
  	}
  	
    if($documentOrganisations[4] != "")
    {
      $hierarchy[] = $this->retrieveOrganisation($documentOrganisations[4]);
    }
  	
    // remove duplicates, reset array index to be continuous
    $hierarchy = array_merge(array_unique($hierarchy));

  	if(count($hierarchy) > 0)
  	{
  		if(count($hierarchy) > 1)
  		{
	    	
	      $i = 0;
	      while(($i + 1) < count($hierarchy))
	      {
	      	$this->setParentOrganisation($hierarchy[$i], $hierarchy[$i + 1]);
	      	$i++;
	      }
	    }
	    
	    return $hierarchy[0];
  	}
  	else
  	{
  		return NULL;
  	}
  }
  
  private function retrieveOrganisation($name)
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
  
  private function setParentOrganisation($child, $parent)
  {
  	$organisation = Doctrine::getTable('Organisation')->find($child);
  	
  	if($organisation != NULL)
  	{
	  	if($organisation->get('parent_id') != $parent)
	  	{
	  	  $organisation->set('parent_id', $parent);
	      $organisation->save();
	  	}
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
  
  public function saveVotesForDocument($document, $legalValueName, $voteRecord)
  {
  	
  	foreach($this->countries as $country)
  	{
  		$vote = new Vote();
  		$vote->set('document_id', $document);
  		$vote->set('country_id', $country->get('id'));
  		
  		if(strtolower($legalValueName) == "non-legally binding" && strtolower($voteRecord) == "adopted without a vote")
  		{
  			$vote->set('type', $voteRecord);
  		}
  		else if(strtolower($legalValueName) == "non-legally binding" && strtolower($voteRecord) != "adopted without a vote")
  		{
  			$vote->set('type', "yes");
  		}
  		else
  		{
  			//Legally binding ...
  		}
  		
  		$vote->save();
  	}
  }
}