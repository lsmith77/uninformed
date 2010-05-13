<?php
/**
 * Clause history partial
 *
 * @param     $clause
 * 
 */
$rootclauses = $clause->getClausesByRoot();
$currentDoc = $clause->Document;
$rootdocuments = $currentDoc->getDocumentsByRoot();
$history = array();
?>
<table id="history" class="collapsed">
    <thead>
        <tr>
            <th>Year</th>
            <th>Changes</th>
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
            <td>
                <?php echo $rootdoc; ?>
                <?php if (isset($rootclauses[$rootdoc->getId()])): ?>
                    <?php echo $rootclauses[$rootdoc->getId()]->ClauseBody->getContent(); ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>