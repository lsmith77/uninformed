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
        $this->latestClauseOnly = true;
    }

    public function executeClauseResultsPage(sfWebRequest $request)
    {
        $this->query = $request->getGetParameter('q');
        $this->tagMatch = $request->getGetParameter('tm', 'any');
        $this->tags = (array) $request->getGetParameter('t');
        $this->latestClauseOnly = $request->getGetParameter('l');
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
        $this->tagMatch = $request->getGetParameter('tm', 'any');
        $this->tags = (array) $request->getGetParameter('t');
        $this->latestClauseOnly = $request->getGetParameter('l');
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
                'values' =>
             array(
              0 => 'legally binding',
              1 => 'non-legally binding',
              2 => 'support document',
             ),
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
            $op = ($this->tagMatch == 'all') ? ' AND ' : ' OR ';
            $subcritieria = new sfLuceneCriteria;
            foreach ($tags as $tag) {
                $subcritieria->addFieldSane('tag_ids', $tag, $op);
            }
            $criteria->add($subcritieria);
        }

        if ($this->latestClauseOnly) {
            $criteria->addFieldSane('is_latest_clause_body', 'true', 'AND');
        }

        if (!empty($this->query)) {
            $subcritieria = new sfLuceneCriteria;
            $subcritieria->addFieldSane('title', $this->query);
            $subcritieria->addFieldSane('content', $this->query, 'OR');
            $criteria->add($subcritieria);

            $criteria->addParam('hl', 'true');
            $criteria->addParam('hl.fl', '*');
            $criteria->addParam('hl.fragsize', '0');
            $criteria->addParam('hl.simple.pre', '<strong>');
            $criteria->addParam('hl.simple.post', '</strong>');
        }

        if (isset($this->filters['legal_value'])) {
            $legal_values = array_intersect($this->filters['legal_value'], $facets['legal_value']['values']);
            if (!empty($legal_values)) {
                $fq = isset($fq) ? "$fq AND " : '';
                $fq.= '{!tag=dt}legal_value:(-"'.implode('" -"', $legal_values).'")';
            }
            unset($this->filters['legal_value']);
        }

        if ($this->filters) {
            foreach ($this->filters as $filter => $ids) {
                if (!$this->checkArrayOfInteger($ids)) {
                    $output = array('status' => 'error', 'message' => "parameter 'f' for key '$filter' to be an array of integer");
                    return $this->returnJson($output);
                }
                if (empty($facets[$filter])) {
                    $output = array('status' => 'error', 'message' => "unsupported filter '$filter'");
                    return $this->returnJson($output);
                }
                $filter = $filter;
                $fq = isset($fq) ? "$fq AND " : '';
                $fq.= '{!tag=dt}'.$filter.':(-"'.implode('" -"', $ids).'")';
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
                        $filters[$facet][] = array('name' => $value, 'id' => $value);
                    }
                } else {
                    $q = Doctrine_Query::create()
                        ->select("$model.id, $model.name")
                        ->from($model)
                        ->whereIn("$model.id", array_keys($solr));
                    if ($model == 'Organisation') {
                        $q->innerJoin("$model.OrganisationParent op")
                            ->select("$model.id, CONCAT(op.name, ' ', $model.name) AS name");
                    }
                    $filters[$facet] = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
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
            $maxScore = $results->getRawResult()->response->maxScore;

            $highlighting = array();
            if (!empty($results->getRawResult()->highlighting)) {
                foreach ($results->getRawResult()->highlighting as $sfl_guid => $highlight) {
                    $highlight = (array)$highlight;
                    foreach ($highlight as $key => $values) {
                        $highlighting[$sfl_guid][$key] = reset($values);
                    }
                }
            }

            $clauses = array();
            foreach ($data as $item) {
                $clause = $item->getField('clause_id');
                if (!empty($clause)) {
                    $sfl_guid = $item->getField('sfl_guid');
                    $score = $item->getField('score');
                    if (isset($highlighting[$sfl_guid['value']]['title'])) {
                        $title = $highlighting[$sfl_guid['value']]['title'];
                    } else {
                        $title = $item->getField('title');
                        $title = $title['value'];
                    }
                    if (isset($highlighting[$sfl_guid['value']]['content'])) {
                        $content = $highlighting[$sfl_guid['value']]['content'];
                    } else {
                        $content = $item->getField('content');
                        $content = $content['value'];
                    }
                    $clauses[$clause['value']] = array(
                        'title' => $title,
                        'content' => $content,
                        'score' => number_format(100*$score['value']/$maxScore, 2),
                    );
                }
            }

            $data = array();
            if (!empty($clauses)) {
                $q = Doctrine_Query::create()
                    ->select("CONCAT(c.id, '-', c.slug) AS slug, c.document_id, TRIM(CONCAT(c.clause_number, ' ', COALESCE(c.clause_number_information, ''), ' ', COALESCE(c.clause_number_subparagraph, ''))) AS clause_number, cb.id, cb.root_clause_body_id, cit.name")
                    ->from('clause c')
                    ->innerJoin('c.ClauseBody cb')
                    ->leftJoin('cb.ClauseInformationType cit')
                    ->whereIn('c.id', array_keys($clauses))
                    ->orderBY('FIELD(c.id, '.implode(',', array_keys($clauses)).')');
                $data = $q->fetchArray();

                $documents = array();
                foreach ($data as $key => $clause) {
                    $root_clause_body_id = isset($clause['ClauseBody']['root_clause_body_id'])
                        ? $clause['ClauseBody']['root_clause_body_id']
                        : $clause['ClauseBody']['id'];
                    $q = Doctrine_Query::create()
                        ->select('COUNT(c.id)')
                        ->from('Clause c')
                        ->innerJoin('c.ClauseBody cb')
                        ->where('cb.id = ? OR cb.root_clause_body_id = ?', array($root_clause_body_id, $root_clause_body_id));
                    $data[$key]['clauseHistory'] = (bool)$q->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
                    $documents[] = $data[$key]['document_id'];
                    $data[$key]['score'] = $clauses[$clause['id']]['score'];
                    $data[$key]['title'] = $clauses[$clause['id']]['title'];
                    $data[$key]['content'] = $clauses[$clause['id']]['content'];
                }

                $q = Doctrine_Query::create()
                    ->select("CONCAT(d.id, '-', d.slug) AS slug, d.code, d.organisation_id, d.adoption_date, dt.name, dt.legal_value")
                    ->from('Document d INDEXBY d.id')
                    ->innerJoin('d.DocumentType dt')
                    ->whereIn('d.id', $documents);
                $documents = $q->fetchArray();
                foreach ($documents as $key => $document) {
                    $q = Doctrine_Query::create()
                        ->select('so.name, so.parent_id, mo.name, mo.parent_id')
                        ->from('Organisation so')
                        ->innerJoin('so.OrganisationParent mo')
                        ->where('so.id = ?', array($document['organisation_id']));
                    $suborgan = $q->fetchArray();
                    $suborgan = reset($suborgan);
                    if ($suborgan['OrganisationParent']['parent_id']) {
                        $main_organ = $suborgan['OrganisationParent']['name'];
                        $q = Doctrine_Query::create()
                            ->select('o.name')
                            ->from('Organisation o')
                            ->where('o.id = ?', array($suborgan['OrganisationParent']['parent_id']));
                        $organisation =  $q->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);;
                    } else {
                        $main_organ = $suborgan['name'];
                        $organisation =  $suborgan['OrganisationParent']['name'];
                    }

                    if ($documents[$key]['DocumentType']['name'] == 'Resolution'
                        && $main_organ == 'SC'
                        && $organisation == 'UNO'
                    ) {
                        $documents[$key]['isSCResolution'] = true;
                    } else {
                        $documents[$key]['isSCResolution'] = false;
                    }
                    $documents[$key]['Organisation']['name'] = "$organisation $main_organ";
                    $documents[$key]['slug'] = $documents[$key]['id'].'-'.$documents[$key]['slug'];
                }

                foreach ($data as $key => $clause) {
                    $data[$key]['Document'] = $documents[$clause['document_id']];
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
