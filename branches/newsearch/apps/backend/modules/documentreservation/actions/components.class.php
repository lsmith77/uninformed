<?php
 
class documentReservationComponents extends sfComponents
{
  public function executeDocumentReservations()
  {
      $this->documentReservation = $this->vote->retrieveDocumentReservation();
  }
}