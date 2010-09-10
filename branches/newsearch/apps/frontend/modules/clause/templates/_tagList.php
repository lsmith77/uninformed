<?php
/**
 * tag list partial
 *
 * @param     $tags Tags
 *
 */
?>
<div id="tags">
    <?php foreach($tags as $tag): ?>
        <?php echo link_to($tag->getName(), 'clauseSearch', array('t['.$tag->getId().']' => $tag->getName())); ?>
    <?php endforeach; ?>
</div>
<br />
