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
        <?php echo link_to($tag->getName(), 'search'); ?>
    <?php endforeach; ?>
</div>