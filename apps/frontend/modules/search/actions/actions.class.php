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
    protected $facetConfig = array(
        'legal_value' => array(
            'unfolded' => false,
            'label' => 'Legal Value',
         ),
        'adoption_year' => array(
            'unfolded' => false,
            'label' => 'Adoption Year',
         ),
        'organisation_id' => array(
            'model' => 'Organisation',
            'unfolded' => true,
            'label' => 'Organisation',
         ),
        'addressee_ids' => array(
            'model' => 'Addressee',
            'unfolded' => false,
            'label' => 'Addressees',
         ),
        'documenttype_id' => array(
            'model' => 'DocumentType',
            'unfolded' => false,
            'label' => 'Document Type',
         ),
        'information_type_id' => array(
            'model' => 'ClauseInformationType',
            'unfolded' => true,
            'label' => 'Clause Information Type',
         ),
        'operative_phrase_id' => array(
            'model' => 'ClauseOperativePhrase',
            'unfolded' => false,
            'label' => 'Clause Operative Phrase',
         ),
        'tag_ids' => array(
            'model' => 'Tag',
            'unfolded' => true,
            'label' => 'Tags',
         ),
    );

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

    protected function readParameters(sfWebRequest $request)
    {
        $this->query = $request->getGetParameter('q', '');
        $this->tagMatch = $request->getGetParameter('tm', 'all');
        $this->tags = (array) $request->getGetParameter('t');
        $this->latestClauseOnly = $request->getGetParameter('l');
        $this->page = (int) $request->getGetParameter('p', 0);
        $this->documentCode = $request->getGetParameter('dc');     
        $this->searchType = $request->getGetParameter('st');
        $this->filters = (array) $request->getGetParameter('f');
    }

    public function executeIndex(sfWebRequest $request)
    {
        $this->readParameters($request);
        $this->showHelp = true;
    }

    public function executeClauseResultsPage(sfWebRequest $request)
    {
        $this->readParameters($request);
        $this->showHelp = false;
    }

    public function executeUnifiedResultsPage(sfWebRequest $request)
    {
        $this->readParameters($request);
    }

    public function executeSearchDocumentCode(sfWebRequest $request)
    {
        $term = $request->getGetParameter('term');

        // TODO: hide the fact that some code's are used multiple times
        $q = Doctrine_Query::create()
            ->select("d.code AS label")
            ->from('Document d')
            ->where('d.code LIKE ?', array("$term%"))
            ->limit(20)
            ->orderBy('d.code')
            ->groupBy('d.code');
        $documents = $q->fetchArray();
        if (!empty($documents)) {
            array_unshift($documents, array('url' => '', 'label' => $term.'*'));
        }

        return $this->returnJson($documents);
    }

    public function executeSearchDocumentCodeOld(sfWebRequest $request)
    {
        $term = $request->getGetParameter('term');

        // TODO: hide the fact that some code's are used multiple times
        $q = Doctrine_Query::create()
            ->select("CONCAT(d.id, '-', d.slug) AS url, d.code AS label")
            ->from('Document d')
            ->where('d.code LIKE ?', array("$term%"))
            ->limit(20)
            ->orderBy('d.code')
            ->groupBy('d.code');
        $documents = $q->fetchArray();

        foreach ($documents as $key => $document) {
            $documents[$key]['url'] = sfContext::getInstance()->getController()->genUrl('@document?id='.$document['url']);
        }

        return $this->returnJson($documents);
    }

    public function executeSearchTerm(sfWebRequest $request)
    {
        $term = $request->getGetParameter('term');

        $lucene = sfLucene::getInstance('Clause', null);

        $criteria = new sfLuceneFacetsCriteria;

        $criteria->addFacetField('autosuggest');
        $criteria->add('*:*', 'AND', true);
        $criteria->addParam('rows', '1');
        $criteria->addParam('facet.prefix', $term);
        $criteria->addParam('facet.mincount', 5);
        $criteria->addParam('facet.maxcount', 500);
        $criteria->addParam('facet.limit', 10);
        $criteria->addParam('facet.sort', true);

        $results = $lucene->friendlyFind($criteria);
        $terms = $results->getFacetField('autosuggest');
        asort($terms);
        $terms = array_reverse($terms, true);
        $response = array();
        foreach ($terms as $term => $count) {
            $response[] = array(
                'label' => $term,
                'count' => $count,
            );
        }
        return $this->returnJson($response);
    }

    public function executeSearchTags(sfWebRequest $request)
    {
        $term = $request->getGetParameter('term');

        // TODO: for now only show tags that are associated with a clause body
        $q = Doctrine_Query::create()
            ->select('t.id, t.name AS label')
            ->from('Tag t')
            ->innerJoin('t.ClauseBodyTag cbt')
            ->where('t.name LIKE ? OR t.name LIKE ?', array("$term%", "% $term%"))
            ->groupBy('t.id, t.name');
        $tags = $q->fetchArray();

        return $this->returnJson($tags);
    }

    public function executeResults(sfWebRequest $request)
    {
        $this->readParameters($request);
        if (!isset($this->searchType)) {
            return $this->generateOutput();
        }

        $this->showHelp = false;

        $tags = array_keys($this->tags);
        $documentCode = $this->documentCode;
        $limit = 20;

        $lucene = sfLucene::getInstance('Clause', null);

        $criteria = new sfLuceneFacetsCriteria;

        if (!empty($this->query)) {
            try {
                $factory = function() { return new phpSolrQueryTerm(); };
                $parser = new phpSolrQueryParser($factory);

                $stack = array(new phpSolrQueryTermResolutionFinder('AND', $criteria));
                $tokens = $parser->parse($this->query, $stack);
                $terms = $parser->processTerms($tokens);
                $terms->serialize();
            } catch (Exception $e) {
                $query = $this->query;
            }
        } else {
            $query = $this->query;
        }

        if (empty($query) && empty($terms) && empty($tags) && empty($documentCode)) {
            return $this->generateOutput($this->searchType);
        }

        $facets = $this->facetConfig;

        if ($this->searchType === 'document') {
            $this->page = 1;
            $limit = false;
        } else {
            $criteria->setLimit($limit+1);
            $criteria->setOffset($this->page*$limit);
        }

        if (!empty($tags)) {
            if (!$this->checkArrayOfInteger($tags)) {
                $output = array('status' => 'error', 'message' => "parameter 't' needs to be an array of integer");
                return $this->returnJson($output);
            }
            $op = ($this->tagMatch == 'all') ? 'AND' : 'OR';
            $subcritieria = new sfLuceneCriteria;
            foreach ($tags as $tag) {
                $subcritieria->addFieldSane('tag_ids', $tag, $op);
            }
            $criteria->add($subcritieria);
        }

        if ($this->latestClauseOnly) {
            $criteria->addField('+is_latest_clause', 'true', 'AND');
        }

        if (!empty($documentCode)) {
            if (substr($documentCode, -1, 1) === '*') {
                $criteria->addField('+document_code_prefix', substr($documentCode, 0, -1), 'AND');
            } else {
                $criteria->addField('+document_code', $documentCode, 'AND');
            }
        }

        if (!empty($query)) {
            $subcritieria = new sfLuceneCriteria;
            $subcritieria->add('_query_:"{!dismax qf=\'content document_title\' pf=\'content document_title\' mm=0 v=$qq}"', 'AND', true);
            $criteria->add($subcritieria, 'AND');
            $criteria->addParam('qq', $query);

            $criteria->addParam('hl', 'true');
            $criteria->addParam('hl.fl', '*');
            $criteria->addParam('hl.fragsize', '0');
            $criteria->addParam('hl.simple.pre', '<strong>');
            $criteria->addParam('hl.simple.post', '</strong>');
        }

        if ($this->filters) {
            foreach ($this->filters as $filter => $ids) {
                if (empty($ids)) {
                    continue;
                }
                if (empty($facets[$filter])) {
                    $output = array('status' => 'error', 'message' => "unsupported filter '$filter'");
                    return $this->returnJson($output);
                }
                if (empty($facets[$filter]['model'])) {
                    foreach ($ids as $key => $id) {
                        $ids[$key] = sfLuceneCriteria::sanitize($id);
                    }
                } elseif (!$this->checkArrayOfInteger($ids)) {
                    $output = array('status' => 'error', 'message' => "parameter 'f' for key '$filter' to be an array of integer");
                    return $this->returnJson($output);
                }
                $fq = isset($fq) ? "$fq OR " : '';
                $fq.= "$filter:(".implode(' ', $ids).')';
            }
        }
        if (isset($fq)) {
            $fq = "{!tag=dt}!($fq)";
            $criteria->addParam('fq', $fq);
        }

        foreach ($facets as $facet => $configuration) {
            $facets[$facet]['unfolded'] = !empty($facets[$facet]['unfolded']) || !empty($this->filters[$facet]);
            $facets[$facet]['allChecked'] = empty($this->filters[$facet]);
            $criteria->addFacetField("{!ex=dt key=orig_$facet}$facet");
            if (isset($fq)) {
                $criteria->addFacetField($facet);
            }
        }

        $results = $lucene->friendlyFind($criteria);
        $filters = array();
        foreach ($facets as $facet => $configuration) {
            $solr = $results->getFacetField('orig_'.$facet);
            $solr_filtered = $results->getFacetField($facet);

            $filters[$facet] = array();
            if (!empty($solr)) {
                if (empty($configuration['model'])) {
                    if ($facet == 'adoption_year') {
                        ksort($solr);
                    }
                    foreach ($solr as $id => $count) {
                        if ($count) {
                            $array = array('id' => $id, 'name' => ($id ? $id : 'none'), 'count' => $count);
                            if (isset($solr_filtered[$id]) && $count !== $solr_filtered[$id]) {
                                $array['filteredCount'] = $solr_filtered[$id];
                            }
                            $array['isChecked'] = empty($this->filters[$facet]) || !in_array($id, $this->filters[$facet]);
                            $filters[$facet][] = $array;
                        }
                    }
                } else {
                    $model = $configuration['model'];
                    $q = Doctrine_Query::create()
                        ->select("$model.name")
                        ->from("$model INDEXBY $model.id")
                        ->whereIn("$model.id", array_keys($solr));
                    if ($model == 'Organisation') {
                        $q->leftJoin("$model.OrganisationParent op")
                            ->select("$model.id, TRIM(CONCAT(COALESCE(op.name, ''), ' ', $model.name)) AS name");
                    }
                    $values = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
                    foreach ($solr as $id => $count) {
                        if (!empty($count)) {
                            $array = array('id' => $id, 'name' => $values[$id]['name'], 'count' => $count);
                            if (isset($solr_filtered[$id]) && $count !== $solr_filtered[$id]) {
                                $array['filteredCount'] = $solr_filtered[$id];
                            }
                            $array['isChecked'] = empty($this->filters[$facet]) || !in_array($id, $this->filters[$facet]);
                            $filters[$facet][] = $array;
                        }
                    }
                    if (!empty($solr[0])) {
                        $array = array('id' => 0, 'name' => 'Other', 'count' => $solr[0]);
                        if (isset($solr_filtered[$id]) && $solr[0] !== $solr_filtered[0]) {
                            $array['filteredCount'] = $solr_filtered[$id];
                        }
                        $array['isChecked'] = empty($this->filters[$facet]) || !in_array(0, $this->filters[$facet]);
                        $filters[$facet][] = $array;
                    }
                }
            }
        }

        $numFound = 0;
        // extract the data out of the result objects
        $data = $results->toArray();
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
                $clause = $item->getField('id');
                if (!empty($clause)) {
                    $sfl_guid = $item->getField('sfl_guid');
                    $score = $item->getField('score');
                    if (isset($highlighting[$sfl_guid['value']]['document_title'])) {
                        $documentTitle = $highlighting[$sfl_guid['value']]['document_title'];
                    } else {
                        $documentTitle = $item->getField('document_title');
                        $documentTitle = $documentTitle['value'];
                    }
                    if (isset($highlighting[$sfl_guid['value']]['content'])) {
                        $content = $highlighting[$sfl_guid['value']]['content'];
                    } else {
                        $content = $item->getField('content');
                        $content = $content['value'];
                    }
                    $clauses[$clause['value']] = array(
                        'documentTitle' => $documentTitle,
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

                $document_ids = array();
                foreach ($data as $key => $clause) {
                    $root_clause_body_id = isset($clause['ClauseBody']['root_clause_body_id'])
                        ? $clause['ClauseBody']['root_clause_body_id']
                        : $clause['ClauseBody']['id'];
                    if ($this->latestClauseOnly) {
                        $q = Doctrine_Query::create()
                            ->select('COUNT(c.id)')
                            ->from('Clause c')
                            ->innerJoin('c.ClauseBody cb')
                            ->where('cb.id = ? OR cb.root_clause_body_id = ?', array($root_clause_body_id, $root_clause_body_id));
                        $data[$key]['clauseHistory'] = $q->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
                        $data[$key]['clauseHistory'] = $data[$key]['clauseHistory'] > 1 ? 1 : 0;
                    } else {
                        $data[$key]['clauseHistory'] = 0;
                    }
                    $document_ids[] = $data[$key]['document_id'];
                    $data[$key]['score'] = $clauses[$clause['id']]['score'];
                    $data[$key]['documentTitle'] = $clauses[$clause['id']]['documentTitle'];
                    $data[$key]['content'] = $clauses[$clause['id']]['content'];

                    $q = Doctrine_Query::create()
                        ->select('t.name')
                        ->from('Tag t')
                        ->innerJoin('t.ClauseBodyTag cbt')
                        ->where('cbt.clause_body_id = ?', array($clause['ClauseBody']['id']));

                    $data[$key]['Tags'] = $q->fetchArray();;
                    foreach ($data[$key]['Tags'] as $tagkey => $tag) {
                        $data[$key]['Tags'][$tagkey]['highlight'] = in_array($tag['id'], $tags);
                    }
                }

                $q = Doctrine_Query::create()
                    ->select("CONCAT(d.id, '-', d.slug) AS slug, d.code, d.organisation_id, d.is_ratified, d.adoption_date, dt.name, dt.legal_value")
                    ->from('Document d INDEXBY d.id')
                    ->innerJoin('d.DocumentType dt')
                    ->whereIn('d.id', $document_ids);
                $documents = $q->fetchArray();

                foreach ($documents as $key => $document) {
                    if (empty($document['organisation_id'])) {
                        $documents[$key]['Organisation']['name'] = "Other";
                        $documents[$key]['isSCResolution'] = false;
                        continue;
                    }

                    $q = Doctrine_Query::create()
                        ->select('so.name, so.parent_id, mo.name, mo.parent_id')
                        ->from('Organisation so')
                        ->leftJoin('so.OrganisationParent mo')
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

                    if ($documents[$key]['DocumentType']['name'] == 'resolution'
                        && $main_organ == 'SC'
                        && $organisation == 'UNO'
                    ) {
                        $documents[$key]['isSCResolution'] = true;
                    } else {
                        $documents[$key]['isSCResolution'] = false;
                    }
                    $documents[$key]['Organisation']['name'] = "$organisation $main_organ";


                    if ($this->searchType === 'document') {
                        $q = Doctrine_Query::create()
                            ->select('t.name')
                            ->from('Tag t')
                            ->innerJoin('t.DocumentTag dt')
                            ->where('dt.document_id = ?', $key);
                        $documents[$key]['Tags'] = $q->fetchArray();
                        foreach ($documents[$key]['Tags'] as $tagkey => $tag) {
                            $documents[$key]['Tags'][$tagkey]['highlight'] = in_array($tag['id'], $tags);
                        }
                    }
                }

                if ($this->searchType === 'document') {
                    foreach ($data as $key => $clause) {
                        $documents[$clause['document_id']]['Clauses'][] = $data[$key];
                        $documents[$clause['document_id']]['documentTitle'] = $data[$key]['documentTitle'];
                    }

                    $data = array_values($documents);
                    $numFound = count($documents);                    
                    // TODO: how to recompute the filter counts?
                } else {
                    foreach ($data as $key => $clause) {
                        $data[$key]['Document'] = $documents[$clause['document_id']];
                    }
                    $numFound = (int)$results->getRawResult()->response->numFound;
                }
            }
        }

        return $this->generateOutput($this->searchType, $data, $filters, $facets, $numFound, $limit);
    }

    protected function generateOutput($searchType = false, $data = array(), $filters = array(), $facets = array(), $numFound = 0, $limit = null)
    {
        $output = array(
            'searchType' => $searchType,
            'data' => $data,
            'filters' => $filters,
            'facets' => $facets,
            'totalResults' => (int)$numFound,
            'page' => $this->page,
            'limit' => $limit,
            'status' => 'success',
            'message' => 'ok'
        );
        return $this->returnJson($output);
    }
}
