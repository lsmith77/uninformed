<?php

/**
 * bookmark actions.
 *
 * @package    symfony
 * @subpackage bookmark
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bookmarkActions extends sfActions
{
   /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        $this->forward404Unless($this->getUser()->isAuthenticated());
        $userId = $this->getUser()->getGuardUser()->getId();
        $this->bookmarks = array();
        $index = 0;
        foreach ($this->getRoute()->getObject()->getBookmarksByUser($userId) as $bookmark) {
             $this->bookmarks[$index]['type'] = $bookmark->getObjectType()==0 ? 'Document' : 'Clause';
             $this->bookmarks[$index]['model'] = $bookmark->getObjectType()==0 ? 'document' : 'clause';
             $this->bookmarks[$index]['id'] = $bookmark->getObjectId();
             $index++;
        }
  }

    public function executeAdd(sfWebRequest $request)
    {
        $this->forward404Unless($this->getUser()->isAuthenticated());
        $userId = $this->getUser()->getGuardUser()->getId();
        $objectType = $request->getParameter('type');
        $objectId = $request->getParameter('id');

        // there are only 2 types [0: documents and 1:clauses]
        $this->forward404Unless($objectType==0||$objectType==1);
        $redirectModule = $objectType ? 'clause' : 'document';

        $bookmark = new Bookmark();
        $bookmark->setObjectType($objectType);
        $bookmark->setObjectId($objectId);
        $bookmark->setUserId($userId);
        try {
            $bookmark->save();
        } catch (Exception $e) {
            // page allready bookmarked..
        }

        $this->getUser()->setFlash('notice', 'Bookmark successfully added');
        $this->redirect($redirectModule, array('id'=>$objectId));
    }

    public function executeRemove(sfWebRequest $request)
    {
        $this->forward404Unless($this->getUser()->isAuthenticated());
        $userId = $this->getUser()->getGuardUser()->getId();
        $objectType = $request->getParameter('type');
        $objectId = $request->getParameter('id');

        // there are only 2 types [0: documents and 1:clauses]
        $this->forward404Unless($objectType==0||$objectType==1);
        $redirectModule = $objectType ? 'clause' : 'document';

        $q = Doctrine_Query::create()
            ->from('Bookmark')
            ->where('object_type = ? AND object_id = ? AND user_id = ?', array($objectType, $objectId, $userId));
        $bookmark = $q->fetchOne();
        if ($bookmark) {
            $bookmark->delete();
        }

        $this->getUser()->setFlash('notice', 'Bookmark successfully removed');
        $this->redirect($redirectModule, array('id'=>$objectId));
    }
}
