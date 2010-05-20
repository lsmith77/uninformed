<form action="<?php echo url_for('clauseSearch'); ?>" method="GET" id="searchForm">
<p class="query">
    <label for="query">Containing</label><br />
    <input type="text" name="q" id="query" value="<?php echo $query ?>" />
    <?php if (!empty($showHelp)): ?>
    <span class="helptext">Enter text to search document title and clause content.</span>
    <?php endif; ?>
</p>

<div class="tags">
    <label for="tags">Tagged with</label><br />
    <input type="text" name="" id="tags" />
    <ul id="taglist">
    <?php
        foreach ($tags as $id => $tag) {
            echo '<li><a><img src="/images/close.gif" /></a> '.$tag.'
            <input type="hidden" name="t['.$id.']" value="'.$tag.'" /></li>';
        }
        if (!count($tags)) {
            echo '<li style="display: none"></li>';
        }
    ?>
    </ul>
    <?php if (!empty($showHelp)): ?>
    <span class="helptext">Enter text to see list of available tags and choose one or several tags.</span>
    <?php endif; ?>
</div>
<p class="tagMatch">
    Matching
    <input type="radio" name="tm" id="anytag" value="any" <?php echo $tagMatch !== 'all' ? 'checked="checked"':'' ?> /><label for="anytag">Any tag</label>
    <input type="radio" name="tm" id="alltags" value="all" <?php echo $tagMatch === 'all' ? 'checked="checked"':'' ?>  /><label for="alltags">All tags</label>
    <?php if (!empty($showHelp)): ?>
    <span class="helptext">Determine if the search should match at least one or all of the above tags.</span>
    <?php endif; ?>
</p>
<p class="latestClauseOnly">
    <input type="checkbox" name="l" id="latestClauseOnly" value="1" <?php echo $latestClauseOnly ? 'checked="checked"':'' ?>  />
    <label for="latestClauseOnly">Latest clause version only</label>
    <?php if (!empty($showHelp)): ?>
    <span class="helptext">Enable this checkbox to search only for the latest version of follow-up documents.</span>
    <?php endif; ?>
</p>
<p>
    <input type="submit" name="s" value="Search" id="search" />
</p>
</form>
