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
<table id="docDetails">
    <thead>
        <?php $organs = $document->getStructuredOrganisation(); ?>
        <tr>
            <th>Document Code</th>
            <th>Date of Adoption</th>
            <th>Organisation</th>
            <?php if($organs['current']): ?><th>Main Organ</th><?php endif; ?>
            <?php if($organs['sub']): ?><th>Sub-Organ</th><?php endif; ?>
            <th>Legal Value</th>
            <th>Type of Document</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $document->code; ?></td>
            <td><?php echo $document->adoption_date; ?></td>
            <td><?php echo $organs['main']; ?></td>
            <?php if($organs['current']): ?><td><?php echo $organs['current']; ?></td><?php endif; ?>
            <?php if($organs['sub']): ?><td><?php echo $organs['sub']; ?></td><?php endif; ?>
            <td><?php $document->DocumentType->getLegalValue(); ?></td>
            <td><?php echo $document->DocumentType; ?></td>
        </tr>
    </tbody>
</table>


<h2><a href="#" class="toggleCol" target="tags">Applied Keyword Tags</a></h2>
<?php include_partial('clause/tagList', array('tags'=>$document->Tags)); ?>

<h2>Voting</h2>

<h2><a href="#" class="toggleCol" target="clauses">Clauses in this Document</a></h2>
<div id="clauses">
    <?php include_partial('clause/clauseListOfDocument', array('clauses' => $document->getClauses())) ?>
</div>

<h2><a href="#" class="toggleCol" target="history">History of this document</a></h2>
<?php include_partial('documentHistory', array('document'=>$document)); ?>

<?php include_component('comment', 'formComment', array('object' => $document)) ?>
<?php include_component('comment', 'list', array('object' => $document, 'i' => 0)) ?>
