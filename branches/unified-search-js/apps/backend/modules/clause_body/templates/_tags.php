<?php
// TODO: always only show the first line and the rest on a mouseover
foreach ($clause_body->Tags as $tag)
    echo link_to($tag, '@default_edit?module=tag&action=edit&id='.$tag->id).'<br />'; ?>
