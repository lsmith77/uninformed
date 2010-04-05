<?php
 
class clauseReservationComponents extends sfComponents
{
  public function executeClauseReservations()
  {
    /*$c = new Criteria();
    $c->addDescendingOrderByColumn(NewsPeer::PUBLISHED_AT);
    $c->setLimit(5);
    $this->news = NewsPeer::doSelect($c);*/
  	$this->myVar = $this->passedParam;
  }
}