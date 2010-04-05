<?php

require_once dirname(__FILE__).'/../lib/documentreservationGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/documentreservationGeneratorHelper.class.php';

/**
 * documentreservation actions.
 *
 * @package    uninformed
 * @subpackage documentreservation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentreservationActions extends autoDocumentreservationActions
{
	public function executeCreateFromVote($request)
	{
		$vote_id = $request->getParameter('vote_id');
		
		$vote = Doctrine::getTable('Vote')->find($vote_id);
    
    if($vote['type'] == 'reservations')
    {
      $reservationText = $request->getParameter('reservationText');

      $documentReservation = new DocumentReservation();
      $documentReservation->set('reservation', $reservationText);
      $documentReservation->set('document_id', $vote['document_id']);
      $documentReservation->set('country_id', $vote['country_id']);
      
      $documentReservation->save();
    	
      $this->message = "The reservation statement has been saved.";
      
    	return "Success";
    }
		else
		{
			$this->message = "The vote is not of type \"reservations\".";
			
		  return "Failure";
	  }
	}
}
