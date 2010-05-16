<?php
/**
* Clauses in a document partial
*
* @param     $clauses
* @param     $currentClause [optional]
*/
?>
<?php $currentClauseId = isset($currentClause) ? $currentClause->clause_number : null; ?>
<?php if(count($clauses)): ?>
<ul class="clauseList">
    <?php foreach($clauses as $clause): ?>
    <?php if($clause->clause_number !== $currentClauseId): ?>
    <li>
        <?php $c = $clause->ClauseBody->getContent(); ?>
        <i><?php echo $clause->clause_number; ?>.</i>
        <?php echo strlen($c)>200 ? (substr($c, 0, 200).'...') : $c; ?>
        <span>
            <?php echo link_to('View', 'clause', array('id' => $clause->getSlug())); ?>
        </span>
    </li>
    <?php endif; ?>
    <?php endforeach; ?>
</ul>
<?php else: ?>
<div>No clauses found!</div>
<?php endif; ?>
