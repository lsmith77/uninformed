<?php

require_once dirname(__FILE__).'/../lib/voteGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/voteGeneratorHelper.class.php';

/**
 * vote actions.
 *
 * @package    uninformed
 * @subpackage vote
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class voteActions extends autoVoteActions
{
	public function executeCreateDocumentReservation($request)
	{
		var_dump($request['country']);
		exit();
	}
}
