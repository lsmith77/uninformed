<?php

/**
 * sfGuardUserProfile form.
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserProfileForm extends BasesfGuardUserProfileForm
{
  public function configure()
  {
      unset($this->widgetSchema['author_id']);
      unset($this->validatorSchema['author_id']);

      unset($this->widgetSchema['created_at']);
      unset($this->validatorSchema['created_at']);

      unset($this->widgetSchema['updated_at']);
      unset($this->validatorSchema['updated_at']);
  }
}
