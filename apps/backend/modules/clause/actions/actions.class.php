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
    public function executeAutocompleteClauseBody($request)
    {
      // TODO: caution, code may be empty
      return autocompleteHelper::executeAutocomplete($this, $request, 'ClauseBody', 'id', 'content');
    }

  public function executeAutocomplete($request)
  {
    $this->getResponse()->setContentType('application/json');

    $limit = min((int)$request->getParameter('limit', 10), 10);
    $id = $request->getParameter('id', 'id');
    if (!in_array($id, array('id', 'clause_body_id'))) {
        return $action->renderText(json_encode(false));
    }

    $q = $request->getParameter('q');

    if (preg_match('/^([^ ]*) +#(\d*)( +[^ ]+)?( +[^ ]+)?(.*)?$/', $q, $matches)) {
        $document = $matches[1];
        $clause_number = trim($matches[2]);
        $matches[3] = trim($matches[3]);
        $matches[4] = trim($matches[4]);
        $matches[5] = trim($matches[5]);
        $clause_additional = array();
        if (!empty($matches[3])) {
            $clause_additional[] = $matches[3];
            if (!empty($matches[4])) {
                $clause_additional[] = $matches[4];
                if (!empty($matches[5])) {
                    $clause_additional[] = $matches[5];
                }
            }
        }
    }

    $values = array();
    if (!isset($clause_number)) {
        // TODO: caution, code may be empty
        $results = Doctrine_Query::create()
            ->select("d.code")
            ->from("Document d")
            ->where("d.code LIKE ?", array($q.'%'))
            ->limit($limit)
            ->orderBy("d.code")
            ->execute(array(), Doctrine::HYDRATE_ARRAY);
        foreach ($results as $i => $result) {
            $values[str_repeat(' ', $i+1)] = $result['code'].' #';
        }
    } else {
        $query = Doctrine_Query::create()
            ->select("c.$id, d.code, c.clause_number, c.clause_number_information, c.clause_number_subparagraph")
            ->from("clause c")
            ->innerJoin('c.Document d')
            ->where("d.code = ?", array($document))
            ->limit($limit)
            ->orderBy("d.code, c.clause_number, c.clause_number_information, c.clause_number_subparagraph");
        if (!empty($clause_number)) {
            $query->andWhere("c.clause_number LIKE ?", array($clause_number.'%'));
            if (!empty($clause_additional)) {
                $query->innerJoin('c.ClauseBody cb')
                        ->innerJoin('cb.ClauseInformationType cit');
                switch (count($clause_additional)) {
                case 1:
                    $query->andWhere("(c.clause_number_information LIKE ? OR c.clause_number_subparagraph LIKE ? OR cit.name LIKE ?)", array($clause_additional[0].'%', $clause_additional[0].'%', $clause_additional[0].'%'));
                    break;
                case 2:
                    $query->andWhere("(c.clause_number_information LIKE ? OR c.clause_number_subparagraph LIKE ?)", array($clause_additional[0].'%', $clause_additional[0].'%'))
                        ->andWhere("(c.clause_number_subparagraph LIKE ? OR cit.name LIKE ?)", array($clause_additional[1].'%', $clause_additional[1].'%'));
                    break;
                case 3:
                    $query->andWhere("c.clause_number_information = ?", array($clause_additional[0]))
                        ->andWhere("c.clause_number_subparagraph LIKE ?", array($clause_additional[1].'%'))
                        ->andWhere("cit.name LIKE ?", array($clause_additional[2].'%'));
                    break;
                }
            }
        }

        $results = $query->execute();
        foreach ($results as $i => $result) {
            $values[$result->{$id}] = (string)$result;
        }
    }

    return $this->renderText(json_encode($values));
  }
}
