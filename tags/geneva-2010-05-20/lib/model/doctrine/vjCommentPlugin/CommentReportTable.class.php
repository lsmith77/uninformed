<?php


class CommentReportTable extends PluginCommentReportTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('CommentReport');
    }
}