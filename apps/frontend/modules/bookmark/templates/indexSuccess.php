<h1>Bookmarks</h1>
<ol class="bookmarks">
    <?php foreach($bookmarks as $bookmark): ?>
    <li>
        <?php $linkLabel = $bookmark['type'].' #'.$bookmark['id']; ?>
        <?php echo link_to($linkLabel, $bookmark['model'], array('id'=>$bookmark['id'])); ?>
    </li>
    <?php endforeach; ?>
</ol>