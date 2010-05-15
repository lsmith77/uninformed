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

        $q = Doctrine_Query::create()
            ->select('id, name AS label')
            ->from('Tag t')
            ->where('t.name LIKE ?', "%$term%");
        $tags = $q->fetchArray();

        return $this->returnJson($tags);
    }

    public function executeResults(sfWebRequest $request)
    {
        $this->query = $request->getGetParameter('q');
        $this->tagMatch = $request->getGetParameter('tm');
        $this->tags = (array) $request->getGetParameter('t');
        $tags = array_keys($this->tags);
        $this->filters = (array) $request->getGetParameter('f');
        $this->page = (int) $request->getGetParameter('p', 0);
        $limit = 20;

        if (empty($this->query) && empty($this->tags)) {
            $output = array(
                'data' => array(),
                'filters' => array(),
                'filterLabels' => array(),
                'totalResults' => 0,
                'status' => 'success',
                'message' => 'ok'
            );
            return $this->returnJson($output);
        }

        $lucene = $this->getInstance();

        $criteria = new sfLuceneFacetsCriteria;

        $facets = array(
            'organisation_id' => 'Organisation',
            'tag_ids' => 'Tag',
            'addressee_ids' => 'Addressee',
            'operative_phrase_id' => 'ClauseOperativePhrase',
            'documenttype_id' => 'DocumentType',
            'information_type_id' => 'ClauseInformationType',
            'legal_value' => array(
                'model' => 'LegalValue',
                'values' => array('non-legally binding', 'legally binding'),
            ),
/*
            'adopted_date' => array(
                'model' => 'Document',
                'values' => 'range',
            ),
*/
        );

        // use to define the order of the filters in the view
        $labels = array(
            'adoption_date' => 'Adopted Date Range',
            'legal_value' => 'Legal Value',
            'organisation_id' => 'Organisation',
            'addressee_ids' => 'Addressee',
            'information_type_id' => 'Clause Information Type',
            'operative_phrase_id' => 'Clause Operative Phrase',
            'tag_ids' => 'Tag',
        );

        foreach ($facets as $facet => $model) {
            $criteria->addFacetField('{!ex=dt}'.$facet);
        }

        $criteria->setLimit($limit+1);
        $criteria->setOffset($this->page*$limit);

        if (!empty($tags)) {
            if (!$this->checkArrayOfInteger($tags)) {
                $output = array('status' => 'error', 'message' => "parameter 't' needs to be an array of integer");
                return $this->returnJson($output);
            }
            $fq_op = ($this->tagMatch == 'all') ? ' AND ' : ' OR ';
        }

        // TODO: fix
//        $fq = '+is_latest_clause_body:true';

        if (empty($this->query)) {
            $criteria->addParam('qt', 'search_tags');
            foreach ($tags as $tag) {
                $criteria->addFieldSane('tag_ids', $tag);
            }
        } else {
            if (!empty($tags)) {
                $fq = isset($fq) ? "$fq AND " : '';
                $fq.= 'tag_ids:'.implode($fq_op.'tag_ids:', $tags);
            }
            $criteria->add($this->query);
        }

        if ($this->filters) {
            $fq = isset($fq) ? "$fq AND " : '';
            foreach ($this->filters as $filter => $ids) {
                if (!$this->checkArrayOfInteger($ids)) {
                    $output = array('status' => 'error', 'message' => "parameter 'f' for key '$filter' to be an array of integer");
                    return $this->returnJson($output);
                }
                if (empty($facets[$filter])) {
                    $output = array('status' => 'error', 'message' => "unsupported filter '$filter'");
                    return $this->returnJson($output);
                }
                $filter = '{!tag=dt}-'.$filter;
                $fq.= $filter.':'.implode(" AND $filter:", $ids);
            }
        }

        if (isset($fq)) {
            $criteria->addParam('fq', $fq);
        }

        $results = $lucene->friendlyFind($criteria);

        $filters = array();
        foreach ($facets as $facet => $model) {
            $solr = $results->getFacetField($facet);
            if (!empty($solr)) {
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
            } else {
                $filters[$facet] = array();
            }
        }

        $data = $results->toArray();

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
                    ->innerJoin('d.DocumentType dt')
                    ->innerJoin('c.ClauseBody cb')
                    ->leftJoin('cb.ClauseOperativePhrase cop')
                    ->leftJoin('cb.ClauseInformationType cit')
                    ->whereIn('id', $clauses);
                $data = $q->fetchArray();
                foreach ($data as $key => $clause) {
                    $root_clause_body_id = isset($clause['ClauseBody']['root_clause_body_id'])
                        ? $clause['ClauseBody']['root_clause_body_id']
                        : $clause['ClauseBody']['id'];
                    $q = Doctrine_Query::create()
                        ->select('COUNT(*)')
                        ->from('Clause c')
                        ->innerJoin('c.ClauseBody cb')
                        ->innerJoin('c.Document d')
                        ->where('cb.id = ? OR cb.root_clause_body_id = ?', array($root_clause_body_id, $root_clause_body_id));
                    $data[$key]['relatedClauseCount'] = $q->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
                    $q = Doctrine_Query::create()
                        ->from('Organisation so')
                        ->leftJoin('so.OrganisationParent mo')
                        ->leftJoin('mo.OrganisationParent o')
                        ->where('so.id = ?', array($data[$key]['Document']['organisation_id']));
                    $data[$key]['Document']['Organisation'] = $q->fetchOne();
                    if ($data[$key]['Document']['DocumentType']['name'] == 'Resolution'
                        && $data[$key]['Document']['Organisation']['name'] == 'SC'
                        && $data[$key]['Document']['Organisation']['OrganisationParent']['name'] == 'UNO'
                    ) {
                        $data[$key]['isSCResolution'] = true;
                    } else {
                        $data[$key]['isSCResolution'] = false;
                    }
                }
            }
        }

        $output = array(
            'data' => $data,
            'filters' => $filters,
            'filterLabels' => $labels,
            'totalResults' => (int)$results->getRawResult()->response->numFound,
            'status' => 'success',
            'message' => 'ok'
        );
        return $this->returnJson($output);
    }
}
