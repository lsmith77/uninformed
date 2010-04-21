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

    $this->widgetSchema['quick edit search'] = new sfWidgetFormDoctrineJQueryQuickSearchAutocompleter(
      array(
        'model' => 'Document',
        'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
      )
    );
    $this->validatorSchema['quick edit search'] = new sfValidatorPass ();

    $this->widgetSchema['parent_document_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(
      array(
        'model' => 'Document',
        'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
      )
    );
    $this->validatorSchema['parent_document_id'] = new sfValidatorPass ();


    $this->widgetSchema['organisation_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(
      array(
        'model' => 'Organisation',
        'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=organisation&action=autocomplete'),
      )
    );
    $this->validatorSchema['organisation_id'] = new sfValidatorPass ();
  }
}
