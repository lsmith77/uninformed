<?php use_javascript('frontend/collapseBoxes.js'); ?>
<?php if ($sf_user->isAuthenticated()): ?>
    <?php if (empty($bookmark)): ?>
        <?php echo link_to('Add Bookmark', 'bookmark_action', array('action' => 'add', 'type' => 'clause', 'id' => $clause->getSlug()), array('class' => 'addbookmark')); ?>
    <?php else: ?>
        <?php echo link_to('Remove Bookmark', 'bookmark_action', array('action' => 'remove', 'type' => 'clause', 'id' => $clause->getSlug()), array('class' => 'removebookmark')); ?>
    <?php endif; ?>
<?php endif; ?>

<h1><?php echo $clause ?></h1>

<h2><a href="#" class="toggleCol" target="docDetails">Document details</a></h2>
<?php include_partial('document/documentDetails', array('document'=>$document)); ?>

<h2><a href="#" class="toggleCol" target="clauseDetails">Clause Details</a></h2>
<table id="clauseDetails">
    <thead>
        <tr>
            <th>Clause Number</th>
            <th>Operative Phrase</th>
            <th>Type of Information</th>
            <th>Addresses</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $clause->getFullClauseNumber(); ?></td>
            <td><?php echo $clauseBody->ClauseOperativePhrase; ?></td>
            <td><?php echo $clauseBody->ClauseInformationType; ?></td>
            <td>
            <?php foreach($clauseBody->Addressees as $address): ?>
            <?php echo $address->getName(); ?><br />
            <?php endforeach; ?>
            </td>
        </tr>
    </tbody>
</table>

<h2><a href="#" class="toggleCol" target="tags">Applied Keyword Tags</a></h2>
<?php include_partial('tagList', array('tags'=>$clauseBody->Tags)); ?>

<h2><a href="#" class="toggleCol" target="clauseContent">Content</a></h2>
<div id="clauseContent">
    <?php echo $sf_data->getRaw('clauseBody')->getContent() ?>
</div>

<?php
$related_documents = $clause->ClauseBody->DocumentClauseRelation;
if ($related_documents->count()) { ?>
<h2><a href="#" class="toggleCol" target="clauseDocumentRelations">Related Documents</a></h2>
<?php include_partial('clauseDocumentRelations', array('related_documents' => $related_documents)); ?>
<?php } ?>

<?php
$related_clauses = $clause->ClauseClauseRelation;
if ($related_clauses->count()) { ?>
<h2><a href="#" class="toggleCol" target="clauseClauseRelations">Related Clauses</a></h2>
<?php include_partial('clauseClauseRelations', array('related_clauses' => $related_clauses)); ?>
<?php } ?>

<h2><a href="#" class="toggleCol" target="clauseHistory">History of this Clause</a></h2>
<?php include_partial('clauseHistory', array('clause'=>$clause)); ?>

<?php include_component('comment', 'formComment', array('object' => $clause)) ?>
<?php include_component('comment', 'list', array('object' => $clause, 'i' => 0)) ?>
