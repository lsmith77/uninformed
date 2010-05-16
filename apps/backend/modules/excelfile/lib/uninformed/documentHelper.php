<?php
class DocumentHelper
{

	private $countries = array();
    private $countriesInOrganisations = array();
	
	function __construct()
	{
		//get the countries once at object initialization
		$this->countries = $this->retrieveAllCountries();
        $this->countriesInOrganisations = $this->retrieveAllCountriesInOrganisations();
	}

	/**
	 * [0] = Sub Organ
	 * [1] = Main Organ New
	 * [2] = Main Organ
	 * [3] = Organisation New
	 * [4] = Organisation
	 *
	 */
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
        $name = strtolower($name);
        $legalValue = strtolower($legalValue);

        $q = Doctrine_Query::create()
            ->select('dt.id')
            ->from('DocumentType dt')
            ->where('name = ?', strtolower($name))
            ->andWhere('legal_value = ?', strtolower($legalValue));

        $documentType = $q->fetchOne();

        $q->free();
        unset($q);
        
        if($documentType != false)
        {
            return $documentType['id'];
        }
        else
        {
            $documentType = new DocumentType();
            $documentType->set('name', $name);
            $documentType->set('legal_value', $legalValue);
            $documentType->save();

            return $documentType->get('id');
        }

        return NULL;
    }

    public function saveVotesForDocument($document_id, $adoption_date, $issuingOrganisation, $legalValueName, $voteRecord)
    {
        if(strtolower($legalValueName) == "non-legally binding" && (strtolower($voteRecord) == "adopted without a vote" || strtolower($voteRecord) == ""))
        {
            foreach($this->countries as $country)
            {
                $this->createVoteForDocument($document_id, $country['id'], "adopted without a vote");
            }
        }
        else if(strtolower($legalValueName) == "non-legally binding" && strtolower($voteRecord) != "adopted without a vote")
        {
            foreach($this->countriesInOrganisations as $countryInOrganisation)
            {
                // match document and organisation
                if($issuingOrganisation == $countryInOrganisation['organisation_id'])
                {
                    // check documents adoption date to be within country´s membership period
                    $entry = strtotime($countryInOrganisation['eff_date']);
                    $exit = strtotime($countryInOrganisation['exp_date']);
                    $adoption = strtotime($adoption_date);

                    if($entry <= $adoption && $adoption <= $exit)
                    {
                        $this->createVoteForDocument($document_id, $countryInOrganisation['country_id'], "yes");
                    }
                    else
                    {
                        //pass
                        //document's adoption date is not within period of country's entry and exit dates
                    }
                }
            }
        }
        else
        {
            //support document
            //or
            //Legally binding ... we do not create any vote for now
            //$this->createVoteForDocument($document->get('id'), $country->get('id'), "");
        }
    }

    private function createVoteForDocument($document_id, $country_id, $vote_type)
    {
        $vote = new Vote();
        $vote->set('document_id', $document_id);
        $vote->set('country_id', $country_id);
        $vote->set('type', $vote_type);
        $vote->save();

        $vote->free(true);
        unset($vote);
    }

    private function retrieveAllCountries()
    {
        $q = Doctrine_Query::create()
            ->select('id')
            ->from('Country c');

        $result = $q->fetchArray();

        $q->free();
        unset($q);

        return $result;
    }

    private function retrieveAllCountriesInOrganisations()
    {
        $q = Doctrine_Query::create()
            ->select('organisation_id, country_id, eff_date, exp_date')
            ->from('CountryOrganisation co');

        $result = $q->fetchArray();

        $q->free();
        unset($q);

        return $result;
    }
}