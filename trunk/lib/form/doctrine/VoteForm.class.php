<?php

/**
 * Vote form.
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VoteForm extends BaseVoteForm
{
    public function configure() {
        $this->widgetSchema['document_id'] = new sfWidgetFormDoctrineJQueryChoiceAutocompleter(
          array(
            'model' => 'Document',
            'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=document&action=autocomplete'),
          )
        );
    }
}
