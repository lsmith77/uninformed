<?php
    use_javascript('search');
?>
<h1>Search UN resolutions and conventions clause by clause.</h1>

<div class="homesearch">
    <fieldset>
        <legend>Notes:</legend>
        <ul>
            <li>Please use the below form to enter search criteria. On the following page additional
        filters can be set to further narrow down the results shown.</li>
            <li>Searches are currently limited to the areas of small arms and light weapons, women and education, clean
        drinking water and malaria.</li>
            <li>The database currently only contains documents and clauses negotiated by states.</li>
        </ul>
    </fieldset>

    <br />

    <?php include_partial('search/searchForm', $sf_data); ?>
</div>
