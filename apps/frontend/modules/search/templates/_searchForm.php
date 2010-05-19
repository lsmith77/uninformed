<form action="<?php echo url_for('clauseSearch'); ?>" method="GET" id="searchForm">
<p class="query">
    <label for="query">Containing</label><br />
    <input type="text" name="q" id="query" value="<?php echo $query ?>" />
    <?php if (!empty($showHelp)): ?>
	<span class="helptext">The text entered will we searched in the document title and the clause content.</span>
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
	<span class="helptext">The text entered will we searched in the list of available tags. Please select a tag to be included in the search or remove after adding.</span>
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
    <label for="latestClauseOnly">Only latest clause version</label>
    <?php if (!empty($showHelp)): ?>
    <span class="helptext">Often newer versions of clauses contain very similar content, to reduce the number of redudant results enable this checkbox</span>
    <?php endif; ?>
</p>
<p>
    <input type="submit" name="s" value="Search" id="search" />
</p>
</form>
