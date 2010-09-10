<?php

require_once dirname(__FILE__).'/../lib/clausereservationGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/clausereservationGeneratorHelper.class.php';

/**
 * clausereservation actions.
 *
 * @package    uninformed
 * @subpackage clausereservation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clausereservationActions extends autoClausereservationActions
{
	public function executeNewFromVote($request)
	{
        $vote_id = $request->getParameter('vote_id');

        $vote = Doctrine::getTable('Vote')->find($vote_id);

        $this->params = array();
        $this->params['document_id'] = $vote['document_id'];
        $this->params['country_id'] = $vote['country_id'];
        $this->params['clauses'] = $this->retrieveClausesByDocument($vote['document_id']);

        return "Success";
	}
	
	public function executeCreateFromVote($request)
	{
        $clause_body_id = $request->getParameter('clause_body_id');
        $country_id = $request->getParameter('country_id');
        $reservationText = $request->getParameter('reservationText');

        $clauseReservation = new ClauseReservation();
        $clauseReservation->set('reservation', $reservationText);
        $clauseReservation->set('clause_body_id', $clause_body_id);
        $clauseReservation->set('country_id', $country_id);

        try {
            $clauseReservation->save();
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
        $document_id = $request->getParameter('document_id');

        $clauseReservation = Doctrine::getTable('ClauseReservation')->find($reservation_id);

        $this->params = array();
        $this->params['clauseReservation'] = $clauseReservation;
        $this->params['clauses'] = $this->retrieveClausesByDocument($document_id);

        return "Success";
    }

    public function executeUpdateFromVote($request)
    {
        $reservation_id = $request->getParameter('reservation_id');
        $reservationText = $request->getParameter('reservationText');
        $clause_body_id = $request->getParameter('clause_body_id');

        $clauseReservation = Doctrine::getTable('ClauseReservation')->find($reservation_id);

        $clauseReservation->set('reservation', $reservationText);
        $clauseReservation->set('clause_body_id', $clause_body_id);

        try {
            $clauseReservation->save();
        }
        catch(Exception $e)
        {
            $this->message = "There has been an error saving the reservation statement:".$e->getMessage();
            return "Failure";
        }

        $this->message = "The reservation statement has been updated.";
        return "Success";
    }

    private function retrieveClausesByDocument($document_id)
    {
        $q = Doctrine_Query::create()
          ->select('c.clause_body_id, c.slug')
          ->from('Clause c')
          ->where('c.document_id = ?', $document_id);

        return $q->fetchArray();
    }
}
