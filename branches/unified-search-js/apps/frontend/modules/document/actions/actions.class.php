<?php

/**
 * document actions.
 *
 * @package    symfony
 * @subpackage document
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $objectSlug = $request->getParameter('id');
      $this->document = Doctrine::getTable('Document')->find($objectSlug);
      if (empty($this->document)) {
          $this->document = Doctrine::getTable('Document')->findOneBySlug(preg_replace('/^\d+-/', '', $objectSlug));
      }

      $this->forward404Unless($this->document);
      if ($objectSlug !== $this->document->getSlug()) {
          $this->redirect('document', array('id' => $this->document->getSlug()), 301);
      }

      $user = $this->getUser();
      if ($user->isAuthenticated()) {
          $q = Doctrine_Query::create()
              ->from('Bookmark')
              ->where('object_type = ? AND object_id = ? AND user_id = ?', array('document', $this->document->getId(), $user->getGuardUser()->getId()));
          $this->bookmark = $q->fetchOne();
      }
  }
}
