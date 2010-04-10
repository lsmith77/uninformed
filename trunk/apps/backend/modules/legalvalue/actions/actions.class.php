<?php

require_once dirname(__FILE__).'/../lib/legalvalueGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/legalvalueGeneratorHelper.class.php';

/**
 * legalvalue actions.
 *
 * @package    uninformed
 * @subpackage legalvalue
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class legalvalueActions extends autoLegalvalueActions
{
  public function executeRetrieveApplicableDecisionTypes($request)
  {
    $document_id = $request->getParameter('document_id');
    $html = '<option value="na">NA</option>';
    
    $q = Doctrine_Query::create()
      ->select('lv.name')
      ->from('LegalValue lv')
      ->leftJoin('DocumentType dt')
      ->leftJoin('Document d')
      ->where('lv.id = dt.legalvalue_id')
      ->andWhere('d.documenttype_id = dt.id')
      ->andWhere('d.id = ?', $document_id);
    
    $legalValue = $q->fetchOne();
          
    if($legalValue != false)
    {
      if($legalValue['name'] == "Non-legally Binding")
      {
        $html = '<option value="yes" selected="selected">yes</option>';
        $html .= '<option value="no">no</option>';
        $html .= '<option value="abstention">abstention</option>';
        $html .= '<option value="not present">not present</option>';
      }
      else if($legalValue['name'] == "Legally Binding")
      {
      	$html = '<option value="signed" selected="selected">signed</option>';
        $html .= '<option value="ratified">ratified</option>';
      }
      else
      {
      	$html = '<option value="otherName">NA</option>';
      }
    }
    else
    {
    	$html = '<option value="returnFALSE">NA</option>';
    }
    
    $this->renderText($html);
    return sfView::NONE;
    
  }
}
