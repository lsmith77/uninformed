<?php
/**
* Clauses in a document partial
*
* @param     $clauses
* @param     $currentClause [optional]
*/
?>
<?php if(!empty($clauses)): ?>
<ul class="clauseList">
    <?php $contents = $sf_data->getRaw('clauses')?>
    <?php foreach($clauses as $key => $clause): ?>
    <li>
        <?php echo link_to($clause->getFullClauseNumber(), 'clause', array('id' => $clause->getSlug())); ?>:
        <?php echo $contents[$key]->ClauseBody->getContent(false); ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
