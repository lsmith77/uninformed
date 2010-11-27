<?php use_stylesheet('/css/jquery.autoSuggest.css'); ?>
<?php use_stylesheet('/css/unifiedSearchForm.css'); ?>
<?php $sf_response->removeJavascript('/js/search.js'); ?>

<?php use_javascript('/js/jquery.autoSuggest.js'); ?>
<?php use_javascript('/js/jquery.form.js'); ?>
<?php use_javascript('/js/jquery.placeholder.js'); ?>
<?php use_javascript('/js/unifiedSearchForm.js'); ?>

<div id="searchIndicator"><span>Updating results..</span></div>

<div class="search">
    <div id="us_filters" class="filters">
        <h2>ResolutionFinder.org</h2>

        <p>Please use the form on the left to enter search criteria.</p>

        <p>Once a search has been triggered additional filters can be set to further narrow down the results shown.</p>

        <p>Searches are currently limited to the areas of small arms and light
        weapons, women and education, clean drinking water and malaria.</p>

        </p>At the moment, the database only contains clauses and documents negotiated by states.</p>
    </div>
</div>

<div class="search_form_and_results">
    <h1>Search for clauses or documents</h1>

    <?php include_partial('search/unifiedSearchForm', $sf_data); ?>

    <div id="us_results" class="results"></div>
</div>

<div style="clear: both;"></div>

<script type="text/x-jqote-template" id="filtersTpl">
    <![CDATA[
    <h2>Search filters</h2>
    <form id="filtersForm">
    <% var f, fId, item, folded, count; %>
    <% var help = new Array;
        help.legal_value = 'legal-values';
        help.addressee_ids = 'addressees';
        help.documenttype_id = 'document-types';
        help.information_type_id = 'information-types';
        help.tag_ids = 'tags';
    %>
    <% for (fId in this.facets) {
        f = this.filters[fId];
        if (f && f.length) { %>
        <% if (!this.facets[fId]['unfolded']) folded = ' folded'; else folded = ''; %>
        <h3>
            <span class="fold<%= folded %>"><span>Collapse/Expand</span></span><%= this.facets[fId]['label'] %>
            <% if (help[fId]) { %>
            <span class="tooltip"><?php echo str_replace('XXX', '<%= help[fId] %>', link_to('?', '@help#XXX', array('target' => 'XXX'))) ?></span>
            <% } %>
        </h3>
        <div class="filterGroup<%= folded %>">
            <% if (f.length > 3) { %>
              <label><input class="selectAll" type="checkbox"<% if (this.facets[fId]['allChecked']) { %><%= 'checked="checked" ' %><% } %>/>All</label>
            <% } %>
            <% for (item in f) { %>
              <% item = f[item]; %>
              <% count = item.filteredCount != undefined ? item.filteredCount : item.count; %>
              <label><input type="checkbox" name="f[<%= $.htmlencode(fId) %>][]" value="<%= item.id %>" <% if (item.isChecked) { %><%= 'checked="checked" ' %><% } %><%= ((item.isChecked && (count == this.totalResults || count == 0)) ? 'disabled="disabled"':'') %> />
              <%= item.name %> <span class="count">(<% if (item.filteredCount != undefined) { %><%= item.filteredCount %> of <% } %><%= item.count %>)</span></label>
            <% } %>
        </div>
    <%  }
    } %>
    </form>
    ]]>
</script>

<script type="text/x-jqote-template" id="resultsTpl">
    <![CDATA[
    <div class="colorcoding">
        legend:
        <span class="scresolutions">SC resolutions</span>
        <span class="ratlegal">legally binding (in force)</span>
        <span class="nonratlegal">legally binding (not in force)</span>
        <span class="nonlegal">non-legally binding</span>
    </div>
    <% if (this.totalResults) { %>
        <h2><%= this.totalResults %> <%= this.searchType %>s found (page <%= (this.page+1) %> of <%= Math.ceil(this.totalResults/this.limit) %>)</h2>
    <% } else if (!this.searchType) { %>
        <h2>no matches</h2>
    <% } else { %>
        <h2>Please enter a search term</h2>
    <% }
    var cnt = this.data.length; %>
    <div class="prevnext">
    <%
    $('.results').data('page', this.page);
    if (this.page > 0) { %>
        <a class="prevPage">prev</a>
    <% }
    if (cnt > this.limit) { cnt = this.limit; %>
        <a class="nextPage">next</a>
    <% }
    for (i = 0; i < cnt; i++) {
    var res = this.data[i];
    var itemclass = 'nonlegal';
    var document;
    if (this.searchType == 'clause') {
        document = res.Document;
    } else {
        document = res;
    }
    if (document.isSCResolution) {
        itemclass = 'scresolutions';
    } else if (document.DocumentType.legal_value == 'legally binding') {
        if (document.is_ratified) {
            itemclass = 'ratlegal';
        } else {
            itemclass = 'nonratlegal';
        }
    }
    %>
    </div>
    <div class="result <%= itemclass %>">
        <h2 class="doctitle highlight">
            <% if (this.searchType == 'clause') { %>
                <?php echo str_replace('XXX', '<%= res.slug %>', link_to('<%= res.documentTitle %>', 'clause', array('id' => 'XXX'), array('target' => '_blank'))) ?>
            <% } else { %>
                <?php echo str_replace('XXX', '<%= res.slug %>', link_to('<%= res.documentTitle %>', 'document', array('id' => 'XXX'), array('target' => '_blank'))) ?>
            <% } %>
        </h2>
        <h3>
            <span class="docdetails"><%= document.code %> (<%= document.adoption_date %>)</span> |
            <span class="organisation"><%= document.Organisation.name %></span> |
            <span class="doctype"><%= document.DocumentType.name %></span>
            <% if (this.searchType == 'clause') { %>
                | <span class="infotype"><%= res.ClauseBody.ClauseInformationType.name %></span>
            <% } %>
        </h3>
        <% if (this.searchType == 'clause') { %>
            <p class="content highlight">
                <%= ("#"+res.clause_number) %>
                <% if (res.content) { %>
                <%= (": "+res.content) %>
                <% } %>
                <% if (res.clauseHistory) { %>
                <span class="clauseHistory"><?php echo str_replace('XXX', '<%= res.slug %>#clauseHistory', link_to('Clause History', 'clause', array('id' => 'XXX'))) ?></span>
                <% } %>
            </p>
        <% } %>
        <p>
            <span class="tags highlight">Tags:
            <%
                for (j = 0; j < res.Tags.length; j++) {
                    var tag = res.Tags[j].name;
                    if (res.Tags[j].highlight) {
                        tag = '<strong>'+tag+'</strong>';
                    }
                    if (j > 0) {
                        tag = ', '+tag;
                    }
            %><%= tag %><%
                }
            %>
            </span>
        <p>
    </div>
    <% } %>
    <div class="prevnext">
    <%
        $('.results').data('page', this.page);
        if (this.page > 0) { %>
        <a class="prevPage">prev</a>
    <% }
    var cnt = this.data.length;
    if (cnt > this.limit) { cnt = this.limit; %>
        <a class="nextPage">next</a>
    <% } %>
    </div>
    ]]>
</script>
