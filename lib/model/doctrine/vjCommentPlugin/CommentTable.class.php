<?php


class CommentTable extends PluginCommentTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Comment');
    }
}