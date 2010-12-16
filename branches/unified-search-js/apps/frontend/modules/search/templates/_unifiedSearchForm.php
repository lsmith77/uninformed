<form action="<?php echo url_for('unifiedSearch'); ?>" method="GET" id="us_form" data-ajaxAction="<?php echo url_for('searchResults', array('action' => 'results')); ?>">
    <div id="help_and_link">
        <a id="us_search_link" data-baseUrl="<?php echo url_for('unifiedSearch', array(), true); ?>" style="display:none;">Link to this search</a>
        <label for="us_help"><input type="checkbox" id="us_help"> Show Help</label>
    </div>

    <div class="query">
        <input type="text" name="q" id="us_query" value="<?php echo $query ?>" placeholder="Containing Text" />
        <span class="tooltip">?<span>Enter text to search document title and clause content. Phrases may be enclosed in double quotes, exclude terms by prefixing with a minus sign ("-") and make terms mandatory by prefixing with a plus sign ("+").</span></span>
    </div>

    <div class="tags">
        <input type="text" name="" id="us_tags" />
        <span class="tooltip">?<span>Enter text to see list of available tags and choose one or several tags.</span></span>
        <div id="us_tags_input_container" style="display:none;">
            <?php foreach ($tags as $value => $name): ?>
                <input type="hidden" name="t[<?php echo escape_once($value); ?>]" value="<?php echo escape_once($name); ?>" />
            <?php endforeach; ?>
        </div>
    </div>

    <div class="documentCode">
        <input type="text" name="dc" id="us_documentCode" value="<?php echo $documentCode ?>" placeholder="Document Code" />
        <span class="tooltip">?<span>Enter text to search document code, select to load the given document</span></span>
    </div>

    <div class="searchButtons">
        Search for
        <input type="button" value="Clauses" data-searchType="clause" /> or
        <input type="button" value="Documents" data-searchType="document" />
    </div>

    <div style="clear: left;"></div>
</form>
