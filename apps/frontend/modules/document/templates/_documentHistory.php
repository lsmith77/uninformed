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
        <tr<?php if ($rootdoc->getId() == $document->getId()) { echo ' style="background-color: grey"'; } ?>>
            <td>
                <?php echo link_to($rootdoc->getCode(), 'document', array('id' => $rootdoc->getSlug())); ?>
            </td>
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
