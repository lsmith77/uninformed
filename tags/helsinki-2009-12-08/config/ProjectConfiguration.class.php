<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    // for compatibility / remove and enable only the plugins you want
    $this->enableAllPluginsExcept(array('sfPropelPlugin', 'sfCompat10Plugin'));
  }

  public function configureDoctrine(Doctrine_Manager $manager) {
    $options = array('baseClassName' => 'BaseRecord');
    sfConfig::set('doctrine_model_builder_options', $options);
  }
}
