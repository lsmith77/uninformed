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
            <?php foreach($document->Clauses as $clause): ?>
            <?php if (isset($clause_ids[$clause->getId()])): ?>
            <li>
                -> <?php echo link_to((string)$clause, 'clause', array('id' => $clause->getSlug())); ?>
            </li>
            <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </li>
    <?php endforeach; ?>
</ul>
