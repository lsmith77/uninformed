<form action="<?php echo url_for('unifiedSearch'); ?>" method="GET" id="searchForm">

<label for="us_help"><input type="checkbox" id="us_help"> Show Help</label>

<div class="query">
    <input type="text" name="q" id="us_query" value="<?php echo $query ?>" placeholder="Containing Text" />
    <span class="tooltip">?<span>Enter text to search document title and clause content. Phrases may be enclosed in double quotes, exclude terms by prefixing with a minus sign ("-") and make terms mandatory by prefixing with a plus sign ("+").</span></span>
</div>

<div class="tags">
    <input type="text" name="" id="us_tags" />
    <span class="tooltip">?<span>Enter text to see list of available tags and choose one or several tags.</span></span>
    <?php
        /*
        foreach ($tags as $id => $tag) {
            echo '<li><a><img src="/images/close.gif" /></a> '.$tag.'
            <input type="hidden" name="t['.$id.']" value="'.$tag.'" /></li>';
        }
        if (!count($tags)) {
            echo '<li style="display: none"></li>';
        }
        */
    ?>
</div>
<div class="documentCode">
    <input type="text" name="dc" id="us_documentCode" value="<?php echo $documentCode ?>" placeholder="Document Code" />
    <span class="tooltip">?<span>Enter text to search document code, select to load the given document</span></span>
</div>
<div class="searchButtons">
    <input type="submit" name="st" value="clause" id="searchClauses" />
    <input type="submit" name="st" value="document" id="searchDocuments" />
</div>

<div style="clear:both"></div>

</form>
