<?php
    use_javascript('search');
?>
<h1>Search for clauses</h1>

<div class="search">
    <div class="form">
        <h2>Update your search</h2>
        <?php include_partial('search/searchForm', $sf_data); ?>
    </div>
    <div class="filters">
    </div>
</div>
<div class="results">
</div>

<script type="text/x-jqote-template" id="filtersTpl">
    <![CDATA[
    <h2>Search filters</h2>
    <form id="filtersForm">
    <% var f, fId, item, folded; %>
    <% for (fId in this.facets) {
        f = this.filters[fId];
        if (f && f.length) { %>
        <% if (!this.facets[fId]['unfolded']) folded = ' folded'; else folded = ''; %>
        <h3><span class="fold<%= folded %>"><span>Collapse/Expand</span></span><%= this.facets[fId]['label'] %></h3>
        <div class="filterGroup<%= folded %>">
            <% if (f.length > 3) { %>
              <label><input class="selectAll" type="checkbox"<% if(this.facets[fId]['allChecked']) { %><%= 'checked="checked" ' %><% } %>/>All</label>
            <% } %>
            <% for (item in f) { %>
              <% item = f[item]; %>
              <label><input type="checkbox" name="f[<%= $.htmlencode(fId) %>][]" value="<%= item.id %>" <% if(item.isChecked) { %><%= 'checked="checked" ' %><% } %><%= (item.count == this.totalResults ? 'disabled="disabled"':'') %> />
              <%= item.name %> <span class="count">(<% if(item.filteredCount != undefined) { %><%= item.filteredCount %> of <% } %><%= item.count %>)</span></label>
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
     <h2><%= this.totalResults %> results (page <%= (this.page+1) %> of <%= Math.ceil(this.totalResults/this.limit) %>)</h2>
    <% } else { %>
    <h2>no matches</h2>
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
    <% }
        for (i = 0; i < cnt; i++) {
        var res = this.data[i];
        var itemclass = 'nonlegal';
        if (res.Document.isSCResolution) {
            itemclass = 'scresolutions';
        } else if (res.Document.DocumentType.legal_value == 'legally binding') {
            if (res.Document.is_ratified) {
                itemclass = 'ratlegal';
            } else {
                itemclass = 'nonratlegal';
            }
        }
        %>
	</div>
    <div class="result <%= itemclass %>">
        <h2>
            <?php echo str_replace('XXX', '<%= res.slug %>', link_to('<%= res.documentTitle %>', 'clause', array('id' => 'XXX'))) ?>
        </h2>
        <h3>
            <span class="docdetails"><%= res.Document.code %> (<%= res.Document.adoption_date %>)</span> |
            <span class="organisation"><%= res.Document.Organisation.name %></span> |
            <span class="doctype"><%= res.Document.DocumentType.name %></span> |
            <span class="infotype"><%= res.ClauseBody.ClauseInformationType.name %></span>
        </h3>
        <p>
            <%= ("#"+res.clause_number) %>
            <% if (res.content) { %>
            <%= (": "+res.content) %>
            <% } %>
            <% if (res.clauseHistory) { %>
            <span class="clauseHistory"><?php echo str_replace('XXX', '<%= res.slug %>#clauseHistory', link_to('Clause History', 'clause', array('id' => 'XXX'))) ?></span>
            <% } %>
        </p>
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
