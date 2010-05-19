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
            <th>References</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> <?php echo link_to((string)$document, 'document', array('id' => $document->getSlug())); ?></td>
            <td><?php echo $document->adoption_date; ?></td>
            <td><?php echo $organs['main']; ?></td>
            <?php if($organs['current']): ?><td><?php echo $organs['current']; ?></td><?php endif; ?>
            <?php if($organs['sub']): ?><td><?php echo $organs['sub']; ?></td><?php endif; ?>
            <td><?php echo $document->getLegalValue(); ?></td>
            <td><?php echo $document->DocumentType; ?></td>
            <td>
                <?php if ($document->getVoteUrl()) { echo link_to('Votes', $document->getVoteUrl()); if ($document->getDocumentUrl()) {echo ', ';}} ?>
                <?php if ($document->getDocumentUrl()) { echo link_to('Source', $document->getDocumentUrl());} ?>
            </td>
        </tr>
    </tbody>
</table>
