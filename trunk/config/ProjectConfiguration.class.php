<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins(
      'sfDoctrinePlugin',
      'sfDoctrineGuardPlugin',
      'sfDoctrineGuardExtraPlugin',
      'sfFormExtraPlugin',
      'sfAdminDashPlugin',
      'sfJqueryReloadedPlugin'
    );
  }

  public function configureDoctrine(Doctrine_Manager $manager)
  {
    sfConfig::set('doctrine_model_builder_options',
      array(
//        'baseTableClassName' => 'MyBaseTable',
        'baseClassName' => 'MyBaseRecord'
      )
    );
    $manager->registerExtension('Blameable');
    $manager->registerExtension('Taggable');
    $manager->registerExtension('Temporal');
    $manager->registerExtension('Sortable');
  }
}
