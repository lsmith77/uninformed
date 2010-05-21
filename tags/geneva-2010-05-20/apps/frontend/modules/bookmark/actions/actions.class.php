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

        $q = Doctrine_Query::create()
            ->select('b.object_id')
            ->from('Bookmark b INDEXBY b.object_id')
            ->where('b.object_type = ? AND b.user_id = ?', array('document', $userId));
        $this->document_ids = $q->fetchArray();

        $q = Doctrine_Query::create()
            ->select('b.object_id')
            ->from('Bookmark b INDEXBY b.object_id')
            ->where('b.object_type = ? AND b.user_id = ?', array('clause', $userId));
        $this->clause_ids = $q->fetchArray();

        $this->documents = $where = array();
        if (!empty($this->document_ids)) {
            $where[] = 'd.id IN ('.implode(',', array_keys($this->document_ids)).')';
        }
        if (!empty($this->clause_ids)) {
            $where[] = 'c.id IN ('.implode(',', array_keys($this->clause_ids)).')';
        }
        if (!empty($where)) {
            $q = Doctrine_Query::create()
                ->from('Document d INDEXBY d.id')
                ->innerJoin('d.Clauses c INDEXBY c.id')
                ->where(implode(' OR ', $where));
            $this->documents = $q->execute();
        }
    }

    public function executeAdd(sfWebRequest $request)
    {
        $this->forward404Unless($this->getUser()->isAuthenticated());
        $userId = $this->getUser()->getGuardUser()->getId();
        $objectType = $request->getParameter('type');
        $objectId = $request->getParameter('id');

        $this->forward404Unless($objectType=='clause'||$objectType=='document');

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
        $this->redirect($objectType, array('id'=>$objectId));
    }

    public function executeRemove(sfWebRequest $request)
    {
        $this->forward404Unless($this->getUser()->isAuthenticated());
        $userId = $this->getUser()->getGuardUser()->getId();
        $objectType = $request->getParameter('type');
        $objectId = $request->getParameter('id');

        $this->forward404Unless($objectType=='clause'||$objectType=='document');

        $q = Doctrine_Query::create()
            ->from('Bookmark')
            ->where('object_type = ? AND object_id = ? AND user_id = ?', array($objectType, $objectId, $userId));
        $bookmark = $q->fetchOne();
        if ($bookmark) {
            $bookmark->delete();
        }

        $this->getUser()->setFlash('notice', 'Bookmark successfully removed');
        $this->redirect($objectType, array('id'=>$objectId));
    }
}
