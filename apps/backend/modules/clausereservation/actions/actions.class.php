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
    
    $q = Doctrine_Query::create()
      ->select('c.clause_body_id, c.slug')
      ->from('Clause c')
      ->where('c.document_id = ?', $vote['document_id']);
      
    $clauses = $q->fetchArray();
    
    $this->params['clauses'] = $clauses;
    
    return "Success";
	}
	
	public function executeCreateFromVote($request)
	{
    $clause_body_id = $request->getParameter('clause_body_id');
    $counry_id = $request->getParameter('country_id');
    $reservationText = $request->getParameter('reservationText');
    
    $clauseReservation = new ClauseReservation();
    $clauseReservation->set('reservation', $reservationText);
    $clauseReservation->set('clause_body_id', $clause_body_id);
    $clauseReservation->set('country_id', $counry_id);
      
    $clauseReservation->save();
    
    return "Success";
	}
}
