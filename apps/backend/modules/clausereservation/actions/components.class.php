<?php
 
class clauseReservationComponents extends sfComponents
{
  public function executeClauseReservations()
  {
      $this->clauseReservations = $this->vote->retrieveClauseReservations();
      
      //var_dump($clauseReservations);
      //exit();


  }
}