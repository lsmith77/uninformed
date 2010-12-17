<?php

slot('title', 'UN Resolution ('.(string)$document->getCode().'): '.(string)$document->getTitle());

$clauses = $document->getClauseList();
$description = '';
if (!empty($clauses)) {
    foreach($clauses as $key => $clause) {
        $description = $clause->ClauseBody->getContent();
        break;
    }
}

slot('description', $description);

$keywords = '';
foreach($document->Tags as $tag) {
    $keywords[] = $tag->getName();
}
$keywords = implode(', ', $keywords);

slot('keywords', $keywords);
slot('robots', 'INDEX, FOLLOW');

?>

<?php if ($sf_user->isAuthenticated()): ?>
    <?php if (empty($bookmark)): ?>
        <?php echo link_to('Add Bookmark', 'bookmark_action', array('action' => 'add', 'type' => 'document', 'id' => $document->getSlug()), array('class' => 'addbookmark')); ?>
    <?php else: ?>
        <?php echo link_to('Remove Bookmark', 'bookmark_action', array('action' => 'remove', 'type' => 'document', 'id' => $document->getSlug()), array('class' => 'removebookmark')); ?>
    <?php endif; ?>
<?php endif; ?>

<h1><?php echo $document->getTitle() ?></h1>

<h2><a href="#" class="toggleCol" target="docDetails">Document details</a></h2>
<?php include_partial('documentDetails', array('document'=>$document)); ?>

<h2><a href="#" class="toggleCol" target="tags">Applied Keyword Tags</a></h2>
<?php include_partial('clause/tagList', array('tags'=>$document->Tags)); ?>

<?php
$related_documents = $document->DocumentDocumentRelation;
if ($related_documents->count()) { ?>
<h2><a href="#" class="toggleCol" target="documentDocumentRelations">Related Documents</a></h2>
<?php include_partial('documentDocumentRelations', array('related_documents' => $related_documents)); ?>
<?php } ?>

<?php
$related_clauses = $document->DocumentClauseRelation;
if ($related_clauses->count()) { ?>
<h2><a href="#" class="toggleCol" target="documentClauseRelations">Related Clauses</a></h2>
<?php include_partial('documentClauseRelations', array('related_clauses' => $related_clauses)); ?>
<?php } ?>

<?php
if ($clauses->count()) { ?>
<h2><a href="#" class="toggleCol" target="clauses">Clauses in this Document</a></h2>
<div id="clauses">
    <?php include_partial('clauseListOfDocument', array('clauses' => $clauses)) ?>
</div>
<?php } ?>

<h2><a href="#" class="toggleCol" target="documentHistory">History of this document</a></h2>
<?php include_partial('documentHistory', array('document'=>$document)); ?>

<?php include_component('comment', 'formComment', array('object' => $document)) ?>
<?php include_component('comment', 'list', array('object' => $document, 'i' => 0)) ?>
