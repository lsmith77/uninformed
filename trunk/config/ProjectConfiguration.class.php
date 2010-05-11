<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $opts = array('http' => array('user_agent' => 'PHP libxml agent',));
    $context = stream_context_create($opts);
    libxml_set_streams_context($context);

    $this->enablePlugins(
      'sfDoctrinePlugin',
      'sfDoctrineGuardPlugin',
      'sfDoctrineGuardExtraPlugin',
      'sfFormExtraPlugin',
      'sfAdminDashPlugin',
      'sfJqueryReloadedPlugin',
      'sfSolrPlugin'
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
    $manager->registerExtension('Temporal');
  }
}
