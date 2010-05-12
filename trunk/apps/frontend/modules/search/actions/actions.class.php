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
        $fulltext = $request->getGetParameter('fulltext');
        $lucene = $this->getInstance();

        $criteria = new sfLuceneFacetsCriteria;
        $criteria->addSane($fulltext);

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

        $data = $lucene->friendlyFind($criteria)->toArray();

        $output = array('data' => $data, 'filters' => $filters);
        return $this->returnJson($output);
    }
}
