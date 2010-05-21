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

    set_include_path(sfConfig::get('sf_lib_dir') . '/vendor' . PATH_SEPARATOR . get_include_path());

    $this->enablePlugins(
      'sfDoctrinePlugin',
      'sfDoctrineGuardPlugin',
      'sfDoctrineApplyPlugin',
      'sfFormExtraPlugin',
      'sfAdminDashPlugin',
      'sfJqueryReloadedPlugin',
      'sfSolrPlugin',
      'vjCommentPlugin'
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
