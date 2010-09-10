<?php

require_once dirname(__FILE__).'/../lib/organisationGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/organisationGeneratorHelper.class.php';

/**
 * organisation actions.
 *
 * @package    uninformed
 * @subpackage organisation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class organisationActions extends autoOrganisationActions
{
  public function executeAutocomplete($request)
  {
    return autocompleteHelper::executeAutocomplete($this, $request, 'Organisation', 'id');
  }
}
