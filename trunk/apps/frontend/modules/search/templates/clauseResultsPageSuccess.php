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
    <% for (var str in this.filters) { %>
        <h3><%= str %></h3>
    <% } %>
    ]]>
</script>
<script type="text/x-jqote-template" id="resultsTpl">
    <![CDATA[
    <h2>Results</h2>
    <% var i, cnt = this.data.length;
    for (i = 0; i < cnt; i++) { %>
    <div class="result">
        Id: <%= this.data[i].id %>
        Guid: <%= this.data[i].sfl_guid %>
    </div>
    <% } %>
    ]]>
</script>