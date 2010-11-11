<?php


class DocumentReservationTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('DocumentReservation');
    }
}