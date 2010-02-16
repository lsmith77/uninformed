<?php
class ClauseHelper
{
  public function retrieveClauseOperativePhrase($name)
  {
    //Retrieve list of existing phrases
    $phrases = Doctrine::getTable('ClauseOperativePhrase')->getAllClauseOperativePhraseNames();
        
    foreach($phrases as $phrase)
    {
      if(strCaseCmp($name,$phrase['name']) == 0)
      {
        return $phrase['id'];
      }
      else
      {
        // pass $foundPhraseInList = false;
      }
    }
    
    $phrase = new ClauseOperativePhrase();  
    $phrase->set('name', $name);
    $phrase->save();
    
    return $phrase->get('id');
  }
	
	public function retrieveClauseInformationType($name)
	{
    //Retrieve list of existing types
    $types = Doctrine::getTable('ClauseInformationType')->getAllClauseInformationTypeNames();
        
    foreach($types as $type)
    {
      if(strCaseCmp($name,$type['name']) == 0)
      {
        return $type['id'];
      }
      else
      {
        // pass $foundTypeInList = false;
      }
    }
    
    $type = new ClauseInformationType();  
    $type->set('name', $name);
    $type->save();
    
    return $type->get('id');
	}
	
  public function retrieveAddressee($name)
  {
    //Retrieve list of existing types
    $addressees = Doctrine::getTable('Addressee')->getAllAddresseeNames();
        
    foreach($addressees as $addressee)
    {
      if(strCaseCmp($name,$addressee['name']) == 0)
      {
        return $addressee['id'];
      }
      else
      {
        // pass $foundTypeInList = false;
      }
    }
    
    $addressee = new Addressee();  
    $addressee->set('name', $name);
    $addressee->save();
    
    return $addressee->get('id');
  }
}