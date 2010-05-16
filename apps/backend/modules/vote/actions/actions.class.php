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
	public function executeRetrieveApplicableDecisionTypes($request)
	{
        $decisionTypes = array();
        $decisionTypes["non-legally binding"] = array("adopted without a vote", "yes", "no", "abstention", "not present");
        $decisionTypes["legally binding"] = array("signed", "ratified");
        $decisionTypes["support document"] = array("");

		$document_id = $request->getParameter('document_id');

        $q = Doctrine_Query::create()
            ->select('d.id, dt.legal_value AS legal_value')
            ->from('Document d')
            ->innerJoin('d.DocumentType dt')
            ->where('d.id = ?', $document_id)
            ->andWhere('d.documenttype_id = dt.id');

        $result = $q->fetchArray();

        $q->free();
        unset($q);

		$options_HTML = "";
        $legalValue = strtolower($result[0]["legal_value"]);

        if(array_key_exists($legalValue, $decisionTypes))
        {
            foreach($decisionTypes[$legalValue] as $decisionType)
            {
                $options_HTML .= "<option>".$decisionType."</option>";
            }
        }
        else
        {
            $options_HTML .= "<option></option>";
        }

        $this->renderText($options_HTML);
        return sfView::NONE;
	}
}
