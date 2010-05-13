<?php
    use_javascript('search');
?>
<script type="text/javascript">
    var query = "<?php echo addslashes($query) ?>";
    var tags = "<?php echo addslashes($query) ?>";
    var tagMatch = "<?php echo addslashes($query) ?>";
</script>
<h1>Search for closes</h1>

<div class="search">
    <div class="form">
        <h2>Update your search</h2>
        <?php include dirname(__FILE__).'/searchForm.php' ?>
    </div>
    <div class="filters">
        <h2>Search filters</h2>
    </div>
</div>
<div class="results">
</div>