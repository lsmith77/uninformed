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
    <% for (var str in this.filterLabels) {
        var f = this.filters[str];
        if (f && f.length) { %>
        <h3><%= this.filterLabels[str] %></h3>
        <% for (var item in f) { %>
        <% item = f[item]; %>
        <input type="checkbox" name="f[<%= str %>][]" value="<%= item.id %>" checked="checked" <%= (item.count == this.totalResults ? 'disabled="disabled"':'') %> />
        <%= item.name %> <span class="count">(<%= item.count %>)</span><br />
        <% } %>
    <%  }
    } %>
    </form>
    ]]>
</script>
<script type="text/x-jqote-template" id="resultsTpl">
    <![CDATA[
    <h2>Results (<%= this.totalResults %>)</h2>
    <% var i, cnt = this.data.length;
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
        <p><%= ("#"+res.clause_number+": "+res.content) %></p>
    </div>
    <% } %>
    ]]>
</script>
