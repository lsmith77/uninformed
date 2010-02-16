<?php
class DocumentHelper
{
  public function retrieveOrganisation($name)
  {
    //Retrieve list of existing organisations
    $organisations = Doctrine::getTable('Organisation')->getAllOrganisations();
        
    foreach($organisations as $organisation)
    {
      if(strCaseCmp($name,$organisation['name']) == 0)
      {
        return $organisation['id'];
      }
      else
      {
        // pass $foundPhraseInList = false;
      }
    }
    
    $organisation = new Organisation();  
    $organisation->set('name', $name);
    $organisation->save();
    
    return $organisation->get('id');
  }
  
  public function retrieveDocumentType($name)
  {
    //Retrieve list of existing documentTypes
    $documentTypes = Doctrine::getTable('DocumentType')->getAllDocumentTypes();
        
    foreach($documentTypes as $documentType)
    {
      if(strCaseCmp($name,$documentType['name']) == 0)
      {
        return $documentType['id'];
      }
      else
      {
        // pass $foundPhraseInList = false;
      }
    }
    
    $documentType = new DocumentType();  
    $documentType->set('name', $name);
    $documentType->save();
    
    return $documentType->get('id');
  }
}