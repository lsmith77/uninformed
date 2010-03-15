<?php

require_once dirname(__FILE__).'/../lib/clauseGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/clauseGeneratorHelper.class.php';

/**
 * clause actions.
 *
 * @package    uninformed
 * @subpackage clause
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clauseActions extends autoClauseActions
{
  public function executeAutocomplete($request)
  {
    return autocompleteHelper::executeAutocomplete($this, $request, 'Clause');
  }
}
