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
    <% var f, fId, item, folded; %>
    <h2>Search filters</h2>
    <form id="filtersForm">
    <% for (fId in this.filterLabels) {
        f = this.filters[fId];
        if (f && f.length) { %>
        <% if (fId === 'operative_phrase_id' || fId === 'addressee_ids' || fId === 'legal_value') folded = ' folded';
           else folded = ''; %>
        <h3><span class="fold<%= folded %>"><span>Collapse/Expand</span></span><%= this.filterLabels[fId] %></h3>
        <div class="filterGroup<%= folded %>">
            <% if (f.length > 3) { %>
            <label><input class="selectAll" type="checkbox" checked="checked" /> All</label>
            <% } %>
            <% for (item in f) { %>
            <% item = f[item]; %>
            <label><input type="checkbox" name="f[<%= fId %>][]" value="<%= item.id %>" checked="checked" <%= (item.count == this.totalResults ? 'disabled="disabled"':'') %> />
            <%= item.name %> <span class="count">(<%= item.count %>)</span></label>
            <% } %>
        </div>
    <%  }
    } %>
    </form>
    ]]>
</script>

<script type="text/x-jqote-template" id="resultsTpl">
    <![CDATA[
    <h2><%= this.totalResults %> Results (Page <%= (this.page+1) %> of <%= Math.ceil(this.totalResults/this.limit) %>)</h2>
    <h3>
        Document color coding:
        <span style="background-color: blue;">SC resolutions</span>,
        <span style="background-color: red;">ratified legally binding</span>,
        <span style="background-color: indianred;">not ratified legally binding</span>,
        <span style="background-color: green;">non-legally binding</span>
    </h3>
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
        var bgcolor = 'green';
        if (res.Document.isSCResolution) {
            bgcolor = 'blue';
        } else if (res.Document.DocumentType.legal_value == 'legally binding') {
            if (res.Document.is_ratified) {
                bgcolor = 'red';
            } else {
                bgcolor = 'indianred';
            }
        }
        %>
    <div class="result" style="background-color: <%= bgcolor %>">
        <h2>
            <?php echo str_replace('XXX', '<%= res.slug %>', link_to('<%= res.title %>', 'clause', array('id' => 'XXX'))) ?>
            (<%= res.score %>)
            <% if (res.clauseHistory) { %>
                <span class="clauseHistory"><?php echo str_replace('XXX', '<%= res.slug %>#clauseHistory', link_to('H', 'clause', array('id' => 'XXX'))) ?></span>
            <% } %>
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
        </p>
    </div>
    <% } %>
    ]]>
</script>
