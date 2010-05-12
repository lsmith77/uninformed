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

    public function executeIndex(sfWebRequest $request)
    {
    }

    public function executeClauseResultsPage(sfWebRequest $request)
    {
        $this->query = $request->getGetParameter('q');
        $this->tagMatch = $request->getGetParameter('tm');
        $this->tags = $request->getGetParameter('t');
    }

    public function executeResults(sfWebRequest $request)
    {
        $this->query = $request->getGetParameter('q');
        $this->tagMatch = $request->getGetParameter('tm');
        $this->tags = (array)$request->getGetParameter('t');
        $this->filters = (array)$request->getGetParameter('f');

        $lucene = $this->getInstance();

        $criteria = new sfLuceneFacetsCriteria;

        $facets = array(
            'organisation_id' => 'Organisation',
            'tag_ids' => 'Tag',
            'addressee_ids' => 'Addressee',
            'operative_phrase_id' => 'ClauseOperativePhrase',
            'information_type_id' => 'ClauseInformationType',
            'clause_process_id' => 'ClauseProcess',
            'legalvalue_id' => 'LegalValue',
            'decision_type' => array('values' => array('vote','ratification'), 'model' => 'DecisionType'),
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
        if (!empty($this->tags)) {
            // TODO: add validation to ensure we are only getting integers
            $fq_op = ($this->tagMatch == 'all') ? ' AND ' : ' OR ';
            $fq = 'tag_ids:'.implode($fq_op.'tag_ids:', $this->tags);
            $criteria->addParam('fq', $fq);
            if (isset($criteria2)) {
                $criteria2->addParam('fq', $fq);
            }
        }

        // TODO: handle case where both query and tags is empty

        if (isset($criteria2)) {
            $criteria->setLimit(0);
            $fq = isset($fq) ? "($fq) AND " : '';
            foreach ($this->filters as $filter => $ids) {
                // TODO: add validation to ensure we are handle supported $facets
                $fq.= $filter.':'.implode(' AND '.$filter.':', $ids);
            }
            $criteria2->addParam('fq', $fq);
        }

        $results = $lucene->friendlyFind($criteria);

        $filters = array();
        foreach ($facets as $facet => $model) {
            $solr = $results->getFacetField($facet);
            if (is_array($model)) {
                $filters[$model['model']] = array();
                foreach ($model['values'] as $value) {
                    $filters[$model['model']][] = array('id' => $value);
                }
                $model = $model['model'];
            } else {
                $filters[$model] = Doctrine_Query::create()
                    ->from($model)
                    ->whereIn('id', array_keys($solr))
                    ->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
            }
            foreach ($filters[$model] as $key => $value) {
                if (empty($solr[$value['id']])) {
                    unset($filters[$model][$key]);
                } else {
                    $filters[$model][$key]['count'] = $solr[$value['id']];
                }
            }
        }

        $data = isset($criteria2)
            ? $lucene->friendlyFind($criteria2)->toArray()
            : $results->toArray();

        $output = array('data' => $data, 'filters' => $filters);
        return $this->returnJson($output);
    }
}
