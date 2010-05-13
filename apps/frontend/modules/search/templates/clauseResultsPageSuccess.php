<?php
    use_javascript('search');
?>
<h1>Search for closes</h1>

<div class="search">
    <div class="form">
        <h2>Update your search</h2>
        <?php include dirname(__FILE__).'/searchForm.php' ?>
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
        if (f.length) { %>
        <h3><%= this.filterLabels[str] %></h3>
        <% for each (var item in f) { %>
        <input type="checkbox" name="f[<%= str %>][]" value="<%= item.id %>" checked="checked" <%= (item.count !== this.totalResults ? 'disabled="disabled"':'') %> />
        <%= item.name %> <span class="count">(<%= item.count %>)</span><br />
        <% } %>
    <%  }
    } %>
    </form>
    ]]>
</script>
<script type="text/x-jqote-template" id="resultsTpl">
    <![CDATA[
    <h2>Results</h2>
    <% var i, cnt = this.data.length;
    for (i = 0; i < cnt; i++) {
        var res = this.data[i]; %>
    <div class="result">
        <h2><?php echo str_replace('XXX', '<%= (""+res.id + "-" + res.slug) %>', link_to('<%= res.Document.name %>', 'clause', array('id' => 'XXX'))) ?></h2>
        <p><%= res.ClauseBody.content %></p>
        <span class="doctype"><%= res.Document.DocumentType.name %></span>
        <span class="infotype"><%= res.ClauseBody.ClauseInformationType.name %></span>
        <span class="organisation"><%= res.Document.Organisation.name %></span>
    </div>
    <% } %>
    ]]>
</script>