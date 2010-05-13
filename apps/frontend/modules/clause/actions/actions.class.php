<?php

/**
 * clause actions.
 *
 * @package    uninformed
 * @subpackage clause
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clauseActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->clause = $this->getRoute()->getObject();
    $this->forward404Unless($this->clause);
    
    $this->clauseBody = $this->clause->ClauseBody;
    $this->document = $this->clause->Document;
  }
}
