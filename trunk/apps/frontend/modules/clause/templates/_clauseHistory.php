<?php
/**
 * Clause history partial
 *
 * @param     $clause
 *
 */
$rootdocuments = $clause->Document->getDocumentsByRoot();

$rootclauses = $clause->getClausesByRoot();
$rawrootclauses = $rootclauses->getRawValue();
?>
<table id="clauseHistory">
    <thead>
        <tr>
            <th>Document&nbsp;Code</th>
            <th>Year</th>
            <th>Changes</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
        <?php $introduced = null; $content = null; ?>
        <?php foreach($rootdocuments as $i => $rootdoc): ?>
        <?php $current = (isset($rootclauses[$rootdoc->getId()])) ? $rootclauses[$rootdoc->getId()] : null; ?>
        <tr<?php if ($rootclauses[$rootdoc->getId()]->getId() == $clause->getId()) { echo ' class="highlighted"'; } ?>>
            <td>
            <?php echo link_to((string)$rootdoc, 'document', array('id' => $rootdoc->getSlug())); ?>
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
                    if ($iID === $cID) {
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
                <?php if (isset($current)): ?>
                    <?php echo link_to($current->getFullClauseNumber(), 'clause', array('id' => $current->getSlug())); ?>:
                    <?php $new_content = $rawrootclauses[$rootdoc->getId()]->ClauseBody->getContent(); ?>
                     <?php if (isset($content)): ?>
                        <?php echo textdiff::htmlDiff($content, $new_content); ?>
                     <?php else: ?>
                        <?php echo $new_content; ?>
                     <?php endif; ?>
                    <?php $content = $new_content; ?>
                <?php endif; ?>
                </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
