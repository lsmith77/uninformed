<?php
 
class documentReservationComponents extends sfComponents
{
  public function executeDocumentReservations()
  {
    /*$c = new Criteria();
    $c->addDescendingOrderByColumn(NewsPeer::PUBLISHED_AT);
    $c->setLimit(5);
    $this->news = NewsPeer::doSelect($c);*/
  	$this->myVar = $this->passedParam;
  }
}