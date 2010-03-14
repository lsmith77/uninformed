<?php

abstract class MyBaseRecord extends sfDoctrineRecord
{
  protected static $autoCompletable = array();

  // TODO: with PHP 5.3 we can drop the $model parameter and just use "static" instead of "self"
  public static function checkAutoComplete($model, $property) {
    return !empty($model::$autoCompletable[$property]);
  }
}