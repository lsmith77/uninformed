<?php
/**
 * Document history partial
 *
 * @param     $document
 *
 */
$rootdocuments = $document->getDocumentsByRoot();
?>
<table id="history" class="collapsed">
    <thead>
        <tr>
            <th>Year</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rootdocuments as $rootdoc): ?>
        <tr>
            <td>
                <?php echo date('Y',strtotime($rootdoc->getAdoptionDate())); ?>
            </td>
            <td>
                <?php echo $rootdoc->getName(); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>