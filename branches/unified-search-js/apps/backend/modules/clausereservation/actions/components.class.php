<?php
 
class clauseReservationComponents extends sfComponents
{
  public function executeClauseReservations()
  {
      $this->clauseReservations = $this->vote->retrieveClauseReservations();
  }
}