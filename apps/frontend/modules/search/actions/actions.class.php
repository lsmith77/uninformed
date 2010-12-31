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
            'key' => 'legal',
         ),
        'adoption_year' => array(
            'unfolded' => false,
            'label' => 'Adoption Year',
            'key' => 'year',
         ),
        'organisation_id' => array(
            'model' => 'Organisation',
            'unfolded' => true,
            'label' => 'Organisation',
            'key' => 'org',
         ),
        'addressee_ids' => array(
            'model' => 'Addressee',
            'unfolded' => false,
            'label' => 'Addressees',
            'key' => 'addressee',
         ),
        'documenttype_id' => array(
            'model' => 'DocumentType',
            'unfolded' => false,
            'label' => 'Document Type',
            'key' => 'doc-type',
         ),
        'information_type_id' => array(
            'model' => 'ClauseInformationType',
            'unfolded' => true,
            'label' => 'Clause Information Type',
            'key' => 'info-type',
         ),
        'operative_phrase_id' => array(
            'model' => 'ClauseOperativePhrase',
            'unfolded' => false,
            'label' => 'Clause Operative Phrase',
            'key' => 'op-phrase',
         ),
        'tag_ids' => array(
            'model' => 'Tag',
            'unfolded' => true,
            'label' => 'Tags',
            'key' => 'tag',
         ),
    );

    protected $facets = array(
        'document' => array(
            'legal_value',
            'adoption_year',
            'organisation_id',
            'documenttype_id',
            'tag_ids',
        ),
        'clause' => array(
            'legal_value',
            'adoption_year',
            'organisation_id',
            'addressee_ids',
            'documenttype_id',
            'information_type_id',
            'operative_phrase_id',
            'tag_ids',
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

    protected function returnJson($request, $output)
    {
        if (!sfConfig::get('sf_web_debug') || $request->isXmlHttpRequest()) {
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
        $this->query = (string) $request->getGetParameter('q', '');
        $this->tagMatch = $request->getGetParameter('tm', 'all');
        $this->tags = (array) $request->getGetParameter('t');
        $this->latestClauseOnly = $request->getGetParameter('l');
        $this->page = (int) $request->getGetParameter('p', 0);
        $this->documentCode = (string) $request->getGetParameter('dc');
        $this->searchType = (string) $request->getGetParameter('st', 'clause');
        $tmp = (array) $request->getGetParameter('f');
        $filters = array();
        foreach ($tmp as $key => $filter) {
            if (isset($this->facetConfig[$key])) {
                $filters[$key] = array_values($filter);
                continue;
            }
            foreach ($this->facetConfig as $facet => $config) {
                if ($config['key'] === $key) {
                    $filters[$facet] = array_values($filter);
                    break;
                }
            }
        }
        $this->filters = $filters;
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
        if (!empty($documents) && strlen($term) > 2) {
            array_unshift($documents, array('url' => '', 'label' => $term.'*'));
        }

        return $this->returnJson($request, $documents);
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

        return $this->returnJson($request, $documents);
    }

    public function executeSearchTerm(sfWebRequest $request)
    {
        $term = $request->getGetParameter('term');

        $lucene = sfLucene::getInstance('Clause', null);

        $criteria = new sfLuceneFacetsCriteria;

        $facet_field = 'autosuggest';
        if (strpos($term, '"') === 0) {
            $term = substr($term, 1);
            $facet_field = 'autosuggest_shingle';
        }
        $criteria->addFacetField($facet_field);
        $criteria->add('*:*', 'AND', true);
        $criteria->addParam('rows', '1');
        $criteria->addParam('facet.prefix', $term);
        $criteria->addParam('facet.mincount', 5);
        $criteria->addParam('facet.maxcount', 500);
        $criteria->addParam('facet.limit', 10);
        $criteria->addParam('facet.sort', true);

        $results = $lucene->friendlyFind($criteria);
        $terms = $results->getFacetField($facet_field);
        asort($terms);
        $terms = array_reverse($terms, true);
        $response = array();
        foreach ($terms as $term => $count) {
            $response[] = array(
                'label' => $term,
                'count' => $count,
            );
        }
        return $this->returnJson($request, $response);
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

        return $this->returnJson($request, $tags);
    }

    public function executeResults(sfWebRequest $request)
    {
        $this->readParameters($request);
        if (!isset($this->searchType) && !in_array($this->searchType, array('clause', 'document'))) {
            return $this->generateOutput($request);
        }

        $this->showHelp = false;

        $tags = array_keys($this->tags);
        $documentCode = $this->documentCode;
        $limit = 20;

        $lucene = sfLucene::getInstance(ucfirst($this->searchType), null);

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
            return $this->generateOutput($request, $this->searchType);
        }

        $facets = array();
        foreach ($this->facets[$this->searchType] as $facet) {
            $facets[$facet] = $this->facetConfig[$facet];
        }

        $criteria->setLimit($limit+1);
        $criteria->setOffset($this->page*$limit);

        if (!empty($tags)) {
            if (!$this->checkArrayOfInteger($tags)) {
                $output = array('status' => 'error', 'message' => "parameter 't' needs to be an array of integer");
                return $this->returnJson($request, $output);
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
                $criteria->add('document_code_prefix:'.sfLuceneService::escape(substr($documentCode, 0, -1)), 'AND', true);
            } else {
                $criteria->add('document_code:'.sfLuceneService::escape($documentCode), 'AND', true);
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
                    return $this->returnJson($request, $output);
                }
                if (empty($facets[$filter]['model'])) {
                    foreach ($ids as $key => $id) {
                        $ids[$key] = sfLuceneCriteria::sanitize($id);
                    }
                } elseif (!$this->checkArrayOfInteger($ids)) {
                    $output = array('status' => 'error', 'message' => "parameter 'f' for key '$filter' to be an array of integer");
                    return $this->returnJson($request, $output);
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

                    $add_other = false;
                    foreach ($solr as $id => $count) {
                        if (!empty($count) && isset($values[$id]['name'])) {
                            $array = array('id' => $id, 'name' => $values[$id]['name'], 'count' => $count);
                            if (isset($solr_filtered[$id]) && $count !== $solr_filtered[$id]) {
                                $array['filteredCount'] = $solr_filtered[$id];
                            }
                            $array['isChecked'] = empty($this->filters[$facet]) || !in_array($id, $this->filters[$facet]);
                            $filters[$facet][] = $array;
                            if ($add_other !== false) {
                                $add_other = $id;
                            }
                        }
                    }

                    if ($add_other !== false) {
                        $array = array('id' => $add_other, 'name' => 'Other', 'count' => $solr[$add_other]);
                        if (isset($solr_filtered[$id]) && $solr[$add_other] !== $solr_filtered[$add_other]) {
                            $array['filteredCount'] = $solr_filtered[$id];
                        }
                        $array['isChecked'] = empty($this->filters[$facet]) || !in_array($add_other, $this->filters[$facet]);
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

            $metadata = array();
            foreach ($data as $item) {
                $id = $item->getField('id');
                if (!empty($id)) {
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
                    $metadata[$id['value']] = array(
                        'documentTitle' => $documentTitle,
                        'content' => $content,
                        'score' => number_format(100*$score['value']/$maxScore, 2),
                    );
                }
            }

            $data = array();
            if (!empty($metadata)) {
                if ($this->searchType === 'document') {
                    $document_ids = array_keys($metadata);
                } else {
                    $q = Doctrine_Query::create()
                        ->select("CONCAT(c.id, '-', c.slug) AS slug, c.document_id, TRIM(CONCAT(c.clause_number, ' ', COALESCE(c.clause_number_information, ''), ' ', COALESCE(c.clause_number_subparagraph, ''))) AS clause_number, cop.name, c.id, cb.id, cb.root_clause_body_id, cit.name")
                        ->from('clause c')
                        ->innerJoin('c.ClauseBody cb')
                        ->leftJoin('cb.ClauseInformationType cit')
                        ->leftJoin('cb.ClauseOperativePhrase cop')
                        ->whereIn('c.id', array_keys($metadata))
                        ->orderBY('FIELD(c.id, '.implode(',', array_keys($metadata)).')');
                    $clauses = $q->fetchArray();

                    $document_ids = array();
                    foreach ($clauses as $key => $clause) {
                        $root_clause_body_id = isset($clause['ClauseBody']['root_clause_body_id'])
                            ? $clause['ClauseBody']['root_clause_body_id']
                            : $clause['ClauseBody']['id'];
                        if ($this->latestClauseOnly) {
                            $q = Doctrine_Query::create()
                                ->select('COUNT(c.id)')
                                ->from('Clause c')
                                ->innerJoin('c.ClauseBody cb')
                                ->where('cb.id = ? OR cb.root_clause_body_id = ?', array($root_clause_body_id, $root_clause_body_id));
                            $clauses[$key]['clauseHistory'] = $q->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
                            $clauses[$key]['clauseHistory'] = $clause['clauseHistory'] > 1 ? 1 : 0;
                        } else {
                            $clauses[$key]['clauseHistory'] = 0;
                        }

                        $document_ids[] = $clause['document_id'];
                        if (!empty($clause['ClauseBody']['ClauseOperativePhrase']['name'])) {
                            $metadata[$clause['id']]['content'] = ClauseBody::applyOperativePhraseToContent($metadata[$clause['id']]['content'], $clause['ClauseBody']['ClauseOperativePhrase']['name']);
                        }
                    }
                }

                $documents = $this->getDocuments($document_ids);

                if ($this->searchType === 'document') {
                    foreach ($documents as $key => $document) {
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

                    $data = array_values($documents);
                } else {
                    foreach ($clauses as $key => $clause) {
                        $q = Doctrine_Query::create()
                            ->select('t.name')
                            ->from('Tag t')
                            ->innerJoin('t.ClauseBodyTag cbt')
                            ->where('cbt.clause_body_id = ?', array($clause['ClauseBody']['id']));

                        $clauses[$key]['Tags'] = $q->fetchArray();
                        foreach ($clauses[$key]['Tags'] as $tagkey => $tag) {
                            $clauses[$key]['Tags'][$tagkey]['highlight'] = in_array($tag['id'], $tags);
                        }

                        $clauses[$key]['Document'] = $documents[$clause['document_id']];
                    }

                    $data = array_values($clauses);
                }

                foreach ($data as $key => $value) {
                    $data[$key]['score'] = $metadata[$value['id']]['score'];
                    $data[$key]['documentTitle'] = $metadata[$value['id']]['documentTitle'];
                    $data[$key]['content'] = $metadata[$value['id']]['content'];
                }

                $numFound = (int)$results->getRawResult()->response->numFound;
            }
        }

        return $this->generateOutput($request, $this->searchType, $data, $filters, $facets, $numFound, $limit);
    }

    protected function getDocuments($document_ids)
    {
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
        }

        return $documents;
    }

    protected function generateOutput($request, $searchType = false, $data = array(), $filters = array(), $facets = array(), $numFound = 0, $limit = null)
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
        return $this->returnJson($request, $output);
    }
}
