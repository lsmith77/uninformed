<form action="<?php echo url_for('clauseSearch'); ?>" method="GET" id="searchForm">

<?php if (!empty($showHelp)): ?>
<fieldset>
<legend>Search documents</legend>
<p class="documentCode">
    <label for="documentCode">Document code</label><br />
    <input type="text" name="" id="documentCode" />
</p>
<p class="documentCodeText">
    <span class="helptext">Enter text to search document code, select to load.</span>
</p>
</fieldset>
<?php endif; ?>

<?php if (!empty($showHelp)): ?>
<fieldset>
<legend>Search clauses</legend>
<?php endif; ?>
<p class="query">
    <label for="query">
        Containing
        <?php if (empty($showHelp)): ?>
        <span class="tooltip">?<span>Enter text to search document title and clause content.</span></span>
        <?php endif; ?>
    </label>
    <br />
    <input type="text" name="q" id="query" value="<?php echo $query ?>" />
    <?php if (!empty($showHelp)): ?>
    <span class="helptext">Enter text to search document title and clause content.</span>
    <?php endif; ?>
</p>

<div class="tags">
    <label for="tags">
        Tagged with
        <?php if (empty($showHelp)): ?>
        <span class="tooltip">?<span>Enter text to see list of available tags and choose one or several tags.</span></span>
        <?php endif; ?>
    </label>
    <br />
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
<?php if (empty($showHelp)): ?>
<span class="tooltip">?<span>Determine whether search results must match any of the selected tags or all.</span></span>
<?php endif; ?>
    <input type="radio" name="tm" id="anytag" value="any" <?php echo $tagMatch !== 'all' ? 'checked="checked"':'' ?> />&nbsp;<label for="anytag">Any tag</label>
    <input type="radio" name="tm" id="alltags" value="all" <?php echo $tagMatch === 'all' ? 'checked="checked"':'' ?>  />&nbsp;<label for="alltags">All tags</label>
    <?php if (!empty($showHelp)): ?>
    <span class="helptext">Determine whether search results must match any of the selected tags or all.</span>
    <?php endif; ?>
</p>

<p class="latestClauseOnly">
    <input type="checkbox" name="l" id="latestClauseOnly" value="1" <?php echo $latestClauseOnly ? 'checked="checked"':'' ?> />
    <label for="latestClauseOnly">
        Latest clause version only
        <?php if (empty($showHelp)): ?>
        <span class="tooltip">?<span>Enable this checkbox to search only for the latest version of follow-up documents.</span></span>
        <?php endif; ?>
    </label>
    <?php if (!empty($showHelp)): ?>
    <span class="helptext">Enable this checkbox to search only for the latest version of follow-up documents.</span>
    <?php endif; ?>
</p>

<p>
    <input type="submit" name="s" value="Search" id="search" />
</p>

<?php if (!empty($showHelp)): ?>
</fieldset>
<?php endif; ?>

</form>
