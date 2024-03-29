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
    $objectSlug = $request->getParameter('id');
    $this->clause = Doctrine::getTable('Clause')->find($objectSlug);
    if (empty($this->clause)) {
      $this->clause = Doctrine::getTable('Clause')->findOneBySlug(preg_replace('/^\d+-/', '', $objectSlug));
    }

    $this->forward404Unless($this->clause);
    if ($objectSlug !== $this->clause->getSlug()) {
        $this->redirect('clause', array('id' => $this->clause->getSlug()), 301);
    }

    $this->clauseBody = $this->clause->ClauseBody;
    $this->document = $this->clause->Document;

    $user = $this->getUser();
    if ($user->isAuthenticated()) {
        $q = Doctrine_Query::create()
            ->from('Bookmark')
            ->where('object_type = ? AND object_id = ? AND user_id = ?', array('clause', $this->clause->getId(), $user->getGuardUser()->getId()));
        $this->bookmark = $q->fetchOne();
    }
  }
}
