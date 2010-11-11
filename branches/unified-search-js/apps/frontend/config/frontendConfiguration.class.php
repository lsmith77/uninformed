<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
      $this->dispatcher->connect('isicsSitemapXML.filter_urls', array('document', 'filterUrls'));
  }
}
