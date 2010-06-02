<?php
    use_javascript('search');
?>
<h1>Search UN resolutions and conventions clause by clause.</h1>

<div class="homesearch">
    <fieldset>
        <legend>Note</legend>
        <span>Searches are currently limited to the areas of small arms and light weapons, women and education, clean drinking water and malaria.</span>
    </fieldset>

    <br />

    <?php include_partial('search/searchForm', $sf_data); ?>
</div>
