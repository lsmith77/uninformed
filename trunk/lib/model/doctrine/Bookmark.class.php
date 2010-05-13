<?php

/**
 * Bookmark
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Bookmark extends BaseBookmark
{
    public function getBookmarksByUser($userId) {

        $query = Doctrine_Query::create()
                ->from('Bookmark b')
                ->where('b.user_id = ?', $userId);

        return $query->execute();
    }
}