<?php use_javascript('frontend/collapseBoxes.js'); ?>
<?php if ($sf_user->isAuthenticated()): ?>
    <?php if (empty($bookmark)): ?>
        <?php echo link_to('Add Bookmark', 'bookmark_action', array('action' => 'add', 'type' => 0, 'id' => $document->getId())); ?>
    <?php else: ?>
        <?php echo link_to('Remove Bookmark', 'bookmark_action', array('action' => 'remove', 'type' => 0, 'id' => $document->getId())); ?>
    <?php endif; ?>
<?php endif; ?>

<h1><?php echo $document->getName() ?></h1>

<h2><a href="#" class="toggleCol" target="docDetails">Document details</a></h2>
<?php include_partial('documentDetails', array('document'=>$document)); ?>

<h2><a href="#" class="toggleCol" target="tags">Applied Keyword Tags</a></h2>
<?php include_partial('clause/tagList', array('tags'=>$document->Tags)); ?>

<h2><a href="#" class="toggleCol" target="clauses">Clauses in this Document</a></h2>
<div id="clauses">
    <?php include_partial('clauseListOfDocument', array('clauses' => $document->getClauses())) ?>
</div>

<h2><a href="#" class="toggleCol" target="documentHistory">History of this document</a></h2>
<?php include_partial('documentHistory', array('document'=>$document)); ?>

<?php include_component('comment', 'formComment', array('object' => $document)) ?>
<?php include_component('comment', 'list', array('object' => $document, 'i' => 0)) ?>
