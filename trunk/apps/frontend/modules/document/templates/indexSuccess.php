<?php use_javascript('frontend/collapseBoxes.js'); ?>

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

<?php $i = 0; ?>
<?php foreach($document->getDocumentsByRoot() as $rootdoc): ?>
<?php echo (++$i).'. '.$rootdoc->getName(); ?><br />
<?php endforeach; ?>

<h2>Voting</h2>

<h2>Applied Keyword Tags</h2>

<h2><a href="#" class="toggleCol" target="clauses">Clauses in this Document</a></h2>
<div id="clauses">
    <?php include_partial('clause/clauseListOfDocument', array('clauses' => $document->getClauses())) ?>
</div>
