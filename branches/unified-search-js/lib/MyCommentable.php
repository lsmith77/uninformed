<?php

class Doctrine_Template_MyCommentable extends Doctrine_Template_Commentable
{
    public function getCommentsQuery()
    {
      return Doctrine::getTable('Comment')->createQuery('c')
        ->innerJoin( 'c.User u')
        ->leftJoin( 'c.CommentReport cr')
        ->where('c.record_id = ?', $this->_invoker->get('id'))
        ->andWhere('c.record_model = ?', $this->_invoker->getTable()->getComponentName())
        ->andWhere('cr.state IS NULL OR cr.state = ?', 'valid')
        ->orderBy('c.created_at ASC');
    }
}
