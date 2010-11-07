<form action="<?php echo url_for('unifiedSearch'); ?>" method="GET" id="searchForm">

<p class="query">
    <label for="query">
        Containing
        <span class="tooltip">?<span>Enter text to search document title and clause content. Phrases may be enclosed in double
        quotes, exclude terms by prefixing with a minus sign ("-") and make terms mandatory by prefixing with a plus sign ("+").</span></span>
    </label>
    <br />
    <input type="text" name="q" id="query" value="<?php echo $query ?>" />
</p>

<div class="tags">
    <label for="tags">
        Tagged with
        <span class="tooltip">?<span>Enter text to see list of available tags and choose one or several tags.</span></span>
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
</div>

<div class="documentCode">
    <label for="tags">
        Document code
        <span class="tooltip">?<span>Enter text to search document code, select to load the given document</span></span>
    </label>
    <br />
    <input type="text" name="dc" id="documentCode" value="<?php echo $documentCode ?>" />
</div>

<p class="latestClauseOnly">
    <input type="checkbox" name="l" id="latestClauseOnly" value="1" <?php echo $latestClauseOnly ? 'checked="checked"':'' ?> />
    <label for="latestClauseOnly">
        Latest clause version only
        <span class="tooltip">?<span>Enable this checkbox to search only for the latest version of follow-up documents.</span></span>
    </label>
</p>

<p>
    <!-- Remove default value 'document' and instead set dynamically to 'clause' or 'document' when pressing one of the submit buttons  -->
    <input type="hidden" name="st" value="document" id="searchType" />
    <input type="submit" name="search" value="Search Clauses" id="searchClauses" />
    <input type="submit" name="search" value="Search Documents" id="searchDocuments" />
</p>

</form>
