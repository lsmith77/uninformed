<?php

abstract class MyBaseRecord extends sfDoctrineRecord
{
  protected static $autoCompletable = array();

  public static function checkAutoComplete($property) {
    return !empty(static::$autoCompletable[$property]);
  }

  public function __toString() {
    $string = parent::__toString();
    if (strlen($string) > 100) {
        $string = substr($string, 0, 100).' ..';
    }
    return $string;
  }
}