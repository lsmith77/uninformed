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
<table id="clauseHistory" class="collapsed">
    <thead>
        <tr>
            <th>Code</th>
            <th>Year</th>
            <th>Changes</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
        <?php $introduced = null; ?>
        <?php foreach($rootdocuments as $i => $rootdoc): ?>
        <?php $current = (isset($rootclauses[$rootdoc->getId()])) ? $rootclauses[$rootdoc->getId()] : null; ?>
        <tr<?php if ($rootclauses[$rootdoc->getId()]->getId() == $clause->getId()) { echo ' style="background-color: grey"'; } ?>>
            <td>
            <?php echo link_to($rootdoc->getCode(), 'document', array('id' => $rootdoc->getSlug())); ?>
            </td>
            <td>
                <?php echo date('Y',strtotime($rootdoc->getAdoptionDate())); ?>
            </td>
            <td>
                <ul>
                <?php
                if (!$i) {
                   echo '<li>Document adopted</li>';
                }
                if ($current && $introduced) {
                    $iID = $introduced->ClauseBody->getId();
                    $cID = $current->ClauseBody->getId();
                    if ($iID===$cID) {
                        echo '<li>Clause copied</li>';
                    } else {
                        echo '<li>Clause changed</li>';
                    }
                } elseif ($current && !$introduced) {
                   $introduced = $current;
                   echo '<li>Clause introduced</li>';
                } elseif (!$current && $introduced) {
                   $introduced = $current;
                   echo '<li>Clause removed</li>';
                }
                ?>
                    </ul>
            </td>
            <td>
                <?php echo link_to($current->getClauseNumber(), 'clause', array('id' => $current->getSlug())); ?>:
                <?php echo isset($current) ? $current->ClauseBody->getContent() : ''; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
