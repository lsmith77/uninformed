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
    public function executeNewFromVote($request)
    {
        $vote_id = $request->getParameter('vote');

        $vote = Doctrine::getTable('Vote')->find($vote_id);

        $this->params = array();
        $this->params['document_id'] = $vote['document_id'];
        $this->params['country_id'] = $vote['country_id'];

        return "Success";
    }
	
    public function executeCreateFromVote($request)
    {        
        $document_id = $request->getParameter('document_id');
        $country_id = $request->getParameter('country_id');
        $reservationText = $request->getParameter('reservationText');

        $documentReservation = new DocumentReservation();
        $documentReservation->set('reservation', $reservationText);
        $documentReservation->set('document_id', $document_id);
        $documentReservation->set('country_id', $country_id);

        try {
            $documentReservation->save();
        }
        catch(Exception $e)
        {
            $this->message = "There has been an error saving the reservation statement:".$e->getMessage();
            return "Failure";
        }

        $this->message = "The reservation statement has been saved.";
        return "Success";
    }

    public function executeEditFromVote($request)
    {
        $reservation_id = $request->getParameter('reservation_id');

        $documentReservation = Doctrine::getTable('DocumentReservation')->find($reservation_id);

        $this->params = array();
        $this->params['reservation_id'] = $reservation_id;
        $this->params['reservationText'] = $documentReservation->get('reservation');

        return "Success";
    }

    public function executeUpdateFromVote($request)
    {
        $reservation_id = $request->getParameter('reservation_id');
        $reservationText = $request->getParameter('reservationText');

        $documentReservation = Doctrine::getTable('DocumentReservation')->find($reservation_id);

        $documentReservation->set('reservation', $reservationText);

        try {
            $documentReservation->save();
        }
        catch(Exception $e)
        {
            $this->message = "There has been an error saving the reservation statement:".$e->getMessage();
            return "Failure";
        }

        $this->message = "The reservation statement has been updated.";
        return "Success";
    }
}
