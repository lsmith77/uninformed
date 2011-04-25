<?php
// TODO: always only show the first line and the rest on a mouseover
foreach ($clause_body->Addressees as $addressee)
    echo link_to($addressee, '@default_edit?module=addressee&action=edit&id='.$addressee->id).'<br />'; ?>
