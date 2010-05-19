<h1>Bookmarks</h1>
<ul class="bookmarks">
    <?php foreach($documents as $document): ?>
    <li>
        <?php $orgs = $document->getStructuredOrganisation(); ?>
        <?php if (isset($document_ids[$document->getId()])): ?>
            <?php echo link_to($document, 'document', array('id' => $document->getSlug())); ?>
        <?php else: ?>
        <?php echo $document->getTitle(); ?>
        <?php endif; ?>
        (<?php echo $orgs['main'].' '.$orgs['current'].' '.$orgs['sub']; ?>)
        <ul class="bookmarks">
            <?php $ordering = explode(',',$document->getClauseOrdering()); ?>
            <?php foreach($ordering as $clause_id): ?>
            <?php if (isset($clause_ids[$clause_id])): ?>
            <li>
                -> <?php echo link_to($document->Clauses[$clause_id]->getClauseNumber(), 'clause', array('id' => $document->Clauses[$clause_id])); ?>
            </li>
            <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </li>
    <?php endforeach; ?>
</ul>
