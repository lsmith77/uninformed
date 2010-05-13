<form action="<?php echo url_for('clauseSearch'); ?>" method="GET" id="searchForm">
<p class="query">
    <label for="query">Containing</label><br />
    <input type="text" name="q" id="query" value="<?php echo $query ?>" />
</p>
<p class="tags">
    <label for="tags">Tagged with</label><br />
    <input type="text" name="" id="tags" />
    <ul id="taglist">
    <?php
        foreach ($tags as $id => $tag) {
            echo '<li><a><img src="/images/close.gif" /></a> '.$tag.'
            <input type="hidden" name="t['.$id.']" value="'.$tag.'" /></li>';
        }
    ?>
    </ul>
</p>
<p class="tagMatch">
    Matching
    <input type="radio" name="tm" id="anytag" value="any" <?php echo $tagMatch === 'any' ? 'checked="checked"':'' ?> /><label for="anytag">Any tag</label></a>
    <input type="radio" name="tm" id="alltags" value="all" <?php echo $tagMatch === 'all' ? 'checked="checked"':'' ?>  /><label for="alltags">All tags</label></a>
</p>
<p>
    <input type="submit" name="s" value="Search" id="search" />
</p>
</form>
