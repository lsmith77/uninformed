<?php
/**
 * Clause history partial
 *
 * @param     $clause
 * 
 */
$rootclauses = $clause->getClausesByRoot();
$rootdocuments = $clause->Document->getDocumentsByRoot();
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
        <?php $introduced = null; ?>
        <?php foreach($rootdocuments as $rootdoc): ?>
        <?php $current = (isset($rootclauses[$rootdoc->getId()])) ? $rootclauses[$rootdoc->getId()] : null; ?>
        <tr>
            <td>
                <?php echo date('Y',strtotime($rootdoc->getAdoptionDate())); ?>
            </td>
            <td>
                <?php
                if ($current && $introduced) {
                    $iID = $introduced->ClauseBody->getId();
                    $cID = $current->ClauseBody->getId();
                    if ($iID===$cID) {
                        echo 'None';
                    } else {
                        echo 'Yes';
                    }
                }
                if ($current && !$introduced) {
                   $introduced = $current;
                   echo 'Clause introduced';
                }
                ?>
            </td>
            <td>
                <?php echo isset($current) ? $current->ClauseBody->getContent() : ''; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>