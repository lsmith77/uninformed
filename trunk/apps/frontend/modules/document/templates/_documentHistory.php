<?php
/**
 * Document history partial
 *
 * @param     $document
 *
 */
$rootdocuments = $document->getDocumentsByRoot();
?>
<table id="documentHistory" class="collapsed">
    <thead>
        <tr>
            <th>Document Code</th>
            <th>Year</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rootdocuments as $rootdoc): ?>
        <tr<?php if ($rootdoc->getId() == $document->getId()) { echo ' class="highlighted"'; } ?>>
            <td>
                <?php echo link_to((string)$rootdoc, 'document', array('id' => $rootdoc->getSlug())); ?>
            </td>
            <td>
                <?php echo $rootdoc->getAdoptionYear(); ?>
            </td>
            <td>
                <?php echo $rootdoc->getTitle(); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
