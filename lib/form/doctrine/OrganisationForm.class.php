<?php

/**
 * Organisation form.
 *
 * @package    form
 * @subpackage Organisation
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class OrganisationForm extends BaseOrganisationForm
{
  public function configure()
  {
    $this->widgetSchema['memberstates_list']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
    $this->widgetSchema['created_at'] = new myWidgetFormPlain();
    $this->widgetSchema['updated_at'] = new myWidgetFormPlain();
  }

  public function updateCreatedAtColumn()
  {
    return false;
  }

  public function updateUpdatedAtColumn()
  {
    return false;
  }
}
