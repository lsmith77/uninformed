<?php

/**
 * Comment
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Comment extends PluginComment
{
    public function preSave($event) {
        if (!$this->exists()) {
            $newReport = new CommentReport();
            $newReport->setReason('new comment');
            $context = sfContext::getInstance();
            $request = $context->getRequest();
            $newReport->setReferer($request->getReferer()."#".$request->getParameter('num'));
            $this->CommentReport[] = $newReport;
        }
    }
}
