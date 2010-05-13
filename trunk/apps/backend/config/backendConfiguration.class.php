<?php

class backendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
  }

  protected $frontendRouting = null;

  public function generateFrontendUrl($name, $parameters = array())
  {
    $host = 'http://'.$_SERVER['HTTP_HOST'];
    if (sfConfig::get('sf_web_debug')) {
        $host.= '/frontend_dev.php';
    }
    return $host.$this->getFrontendRouting()->generate($name, $parameters);
  }

  public function getFrontendRouting()
  {
    if (!$this->frontendRouting)
    {
      $this->frontendRouting = new sfPatternRouting(new sfEventDispatcher());

      $config = new sfRoutingConfigHandler();
      $routes = $config->evaluate(array(sfConfig::get('sf_apps_dir').'/frontend/config/routing.yml'));

      $this->frontendRouting->setRoutes($routes);
    }

    return $this->frontendRouting;
  }
}

function link_to_frontend($label, $name, $parameters = array())
{
  return link_to($label, sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters));

}
