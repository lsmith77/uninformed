<?php

require_once dirname(__FILE__).'/../lib/clause_bodyGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/clause_bodyGeneratorHelper.class.php';

/**
 * clause_body actions.
 *
 * @package    symfony
 * @subpackage clause_body
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clause_bodyActions extends autoClause_bodyActions
{
    public function executeAutocomplete($request)
    {
      // TODO: caution, code may be empty
      return autocompleteHelper::executeAutocomplete($this, $request, 'ClauseBody', 'id', 'content');
    }

}
