<?php
// TODO: always only show the first line and the rest on a mouseover
foreach ($document->Tags as $tag)
    echo link_to($tag, @default_edit, array('module' => 'tag', 'id' => $tag->id, 'action' => 'edit')).'<br />'; ?>