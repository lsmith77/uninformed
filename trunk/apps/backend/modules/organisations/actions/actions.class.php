<?php

require_once dirname(__FILE__).'/../lib/organisationsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/organisationsGeneratorHelper.class.php';

/**
 * organisations actions.
 *
 * @package    docdb
 * @subpackage organisations
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class organisationsActions extends autoOrganisationsActions
{
    public function executeAutocomplete($request)
    {
        return autocompleteHelper::executeAutocomplete($this, $request, 'Organisation');
    }
}
