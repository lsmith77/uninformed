<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DocumentTable extends Doctrine_Table
{
  public function getAllDocuments()
  {
    $q = $this->createQuery('j');
    return $q->fetchArray();
  }
}