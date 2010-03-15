<?php

abstract class MyBaseRecord extends sfDoctrineRecord
{
  protected static $autoCompletable = array();

  public static function checkAutoComplete($property) {
    return !empty(static::$autoCompletable[$property]);
  }
}