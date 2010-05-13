<?php
/*
 * This file is part of the sfLucenePlugin package
 * (c) 2007 - 2008 Carl Vondrick <carl@carlsoft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @package    sfLucenePlugin
 * @subpackage Module
 * @author     Carl Vondrick <carl@carlsoft.net>
 * @version SVN: $Id: actions.class.php 6247 2007-12-01 03:25:13Z Carl.Vondrick $
 */
class searchActions extends sfActions
{
    protected function getInstance()
    {
        return sfLucene::getInstance('ClauseBody', null);
    }

    protected function ensureXmlHttpRequest($request)
    {
        if (!sfConfig::get('sf_web_debug')
            && !$request->isXmlHttpRequest()
            && !$request->getParameter('isXMLHttpRequest')
        ) {
            $this->redirect('homepage');
        }

        return true;
    }

    protected function returnJson($output)
    {
        if (!sfConfig::get('sf_web_debug')) {
            $response = sfContext::getInstance()->getResponse();
            $response->setContentType('application/json');
            $this->getResponse()->setContent(json_encode($output));
            return sfView::NONE;
        }

        $this->setLayout('layout');
        $this->output = $output;
        $this->setTemplate('renderJson');
    }

    protected function checkArrayOfInteger($array) {
        return is_numeric(implode('', $array));
    }

    public function executeIndex(sfWebRequest $request)
    {
        $this->query = '';
        $this->tagMatch = 'any';
        $this->tags = array();
    }

    public function executeClauseResultsPage(sfWebRequest $request)
    {
        $this->query = $request->getGetParameter('q');
        $this->tagMatch = $request->getGetParameter('tm');
        $this->tags = (array) $request->getGetParameter('t');
    }

    public function executeSearchTags(sfWebRequest $request)
    {
        $term = $request->getGetParameter('term');
        // TODO find all tags matching $term
        $tags = array(
            array('id' => 2, 'label' => 'foo'),
            array('id' => 10, 'label' => 'bar'),
        );
        return $this->returnJson($tags);
    }

    public function executeResults(sfWebRequest $request)
    {
        $this->query = $request->getGetParameter('q');
        $this->tagMatch = $request->getGetParameter('tm');
        $this->tags = (array) $request->getGetParameter('t');
        $tags = array_keys($this->tags);
        $this->filters = (array) $request->getGetParameter('f');

        $lucene = $this->getInstance();

        // TODO: add support for is_latest_clause_body
        $criteria = new sfLuceneFacetsCriteria;

        $facets = array(
            'organisation_id' => 'Organisation',
            'tag_ids' => 'Tag',
            'addressee_ids' => 'Addressee',
            'operative_phrase_id' => 'ClauseOperativePhrase',
            'information_type_id' => 'ClauseInformationType',
            'clause_process_id' => 'ClauseProcess',
            'legalvalue_id' => 'LegalValue',
            'decision_type' => array(
                'model' => 'DecisionType',
                'values' => array('vote', 'ratification'),
            ),
        );

        // use to define the order of the filters in the view
        $labels = array(
            'addressee_ids' => 'Addressee',
            'legalvalue_id' => 'Legal Value',
            'decision_type' => 'Decision Type',
            'organisation_id' => 'Organisation',
            'clause_process_id' => 'Clause Process',
            'operative_phrase_id' => 'Clause Operative Phrase',
            'information_type_id' => 'Clause Information Type',
            'tag_ids' => 'Tag',
        );

        foreach ($facets as $facet => $model) {
            $criteria->addFacetField($facet);
        }

        if (!empty($this->filters)) {
            $criteria2 = new sfLuceneCriteria;
        }

        if (!empty($this->query)) {
            $criteria->addSane($this->query);
            if (isset($criteria2)) {
                $criteria2->addSane($this->query);
            }
        }
        if (!empty($tags)) {
            if (!$this->checkArrayOfInteger($tags)) {
                $output = array('status' => 'error', 'message' => "parameter 't' needs to be an array of integer");
                return $this->returnJson($output);
            }
            $fq_op = ($this->tagMatch == 'all') ? ' AND ' : ' OR ';
            $fq = 'tag_ids:'.implode($fq_op.'tag_ids:', $tags);
            $criteria->addParam('fq', $fq);
            if (isset($criteria2)) {
                $criteria2->addParam('fq', $fq);
            }
        }

        if (isset($criteria2)) {
            $criteria->setLimit(0);
            $fq = isset($fq) ? "($fq) AND " : '';
            foreach ($this->filters as $filter => $ids) {
                if (!$this->checkArrayOfInteger($ids)) {
                    $output = array('status' => 'error', 'message' => "parameter 'f' for key '$filter' to be an array of integer");
                    return $this->returnJson($output);
                }
                if (empty($facets[$filter])) {
                    $output = array('status' => 'error', 'message' => "unsupported filter '$filter'");
                    return $this->returnJson($output);
                }
                $filter = '-'.$filter;
                $fq.= $filter.':'.implode(' AND '.$filter.':', $ids);
            }
            $criteria2->addParam('fq', $fq);
        }

        $results = $lucene->friendlyFind($criteria);

        $filters = array();
        foreach ($facets as $facet => $model) {
            $solr = $results->getFacetField($facet);
            if (is_array($model)) {
                $filters[$facet] = array();
                foreach ($model['values'] as $value) {
                    $filters[$facet][] = array('id' => $value);
                }
            } else {
                $filters[$facet] = Doctrine_Query::create()
                    ->from($model)
                    ->whereIn('id', array_keys($solr))
                    ->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
            }
            foreach ($filters[$facet] as $key => $value) {
                if (empty($solr[$value['id']])) {
                    unset($filters[$facet][$key]);
                } else {
                    $filters[$facet][$key]['count'] = $solr[$value['id']];
                }
            }
            // reset the keys to force json to have an array
            $filters[$facet] = array_values($filters[$facet]);
        }

        $data = isset($criteria2)
            ? $lucene->friendlyFind($criteria2)->toArray()
            : $results->toArray();

        // extract the data out of the result objects
        if ($data) {
            $clauses = array();
            foreach ($data as $item) {
                $clause = $item->getField('clause_id');
                if (!empty($clause)) {
                    $clauses[] = $clause['value'];
                }
            }

            $data = array();
            if (!empty($clauses)) {
                $q = Doctrine_Query::create()
                    ->from('clause c')
                    ->innerJoin('c.Document d')
                    ->innerJoin('d.Organisation o')
                    ->innerJoin('d.DocumentType dt')
                    ->innerJoin('dt.LegalValue l')
                    ->innerJoin('c.ClauseBody cb')
                    ->leftJoin('cb.ClauseOperativePhrase cop')
                    ->leftJoin('cb.ClauseInformationType cit')
                    ->leftJoin('cb.ClauseProcess cp')
                    ->whereIn('id', $clauses);
                $data = $q->fetchArray();
                foreach ($data as $key => $clause) {
                    // TODO fetch all clauses with the same root_clause_body_id
                    $data[$key]['relatedClauses'] = array(
                        5 => array('slug' => '5-', 'clause_body_id' => 3, 'code' => 'Asdfsdsdsdfdf'),
                        6 => array('slug' => '6-', 'clause_body_id' => 6, 'code' => 'Asdfsdsdsdfdf'),
                    );
                }
            }
        }

        $output = array(
            'data' => $data,
            'filters' => $filters,
            'filterLabels' => $labels,
            'totalResults' => count($data), // TODO make that the total count if we add paging
            'status' => 'success',
            'message' => 'ok'
        );
        return $this->returnJson($output);
    }
}
