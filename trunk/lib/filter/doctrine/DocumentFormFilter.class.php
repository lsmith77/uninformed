<?php

/**
 * Document filter form.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentFormFilter extends BaseDocumentFormFilter
{
  public function configure()
  {
    parent::configure();

    sfContext::switchTo('backend');

    $this->widgetSchema['code'] = new sfWidgetFormDoctrineJQueryAutocompleter(
      array(
        'model' => 'Document',
        'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
      )
    );

    $this->validatorSchema['code'] = new sfValidatorPass ();
  }
}
