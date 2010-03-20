<?php

require_once dirname(__FILE__).'/../lib/documentGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/documentGeneratorHelper.class.php';

/**
 * document actions.
 *
 * @package    uninformed
 * @subpackage document
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentActions extends autoDocumentActions
{
  public function executeAutocomplete($request)
  {
    return autocompleteHelper::executeAutocomplete($this, $request, 'Document', 'id', 'code');
  }
}
