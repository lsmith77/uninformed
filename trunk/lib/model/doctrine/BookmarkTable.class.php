<?php


class BookmarkTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Bookmark');
    }
}