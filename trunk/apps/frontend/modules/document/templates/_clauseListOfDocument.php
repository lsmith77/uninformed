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
    <?php foreach($clauses as $key => $clause): ?>
    <li>
        <?php echo link_to($clause->getFullClauseNumber(), 'clause', array('id' => $clause->getSlug())); ?>:
        <?php $content = $sf_data->getRaw('clauses')?>
        <?php echo $content[$key]->ClauseBody->getContent(); ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
