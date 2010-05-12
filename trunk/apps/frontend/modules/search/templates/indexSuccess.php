<h1>Search for closes</h1>

<form action="<?php echo url_for('clauseSearch'); ?>" method="GET">
<p>
    <label for="query">Containing</label>
    <input type="text" name="q" id="query" />
</p>
<p>
    <label for="tags">Tagged with</label>
    <input type="text" name="t" id="tags" />
</p>
<p>
    Matching
    <input type="radio" name="tm" id="anytag" value="any" checked="checked" /><label for="anytag">Any tag</a>
    <input type="radio" name="tm" id="alltags" value="all" /><label for="alltags">All tags</a>
</p>
<p>
    <input type="submit" name="s" value="Search" />
</p>
</form>
