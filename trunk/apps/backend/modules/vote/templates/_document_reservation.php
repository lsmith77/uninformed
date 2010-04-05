<?php

$document = $vote->getDocument();
$country = $vote->getCountry();

echo link_to("Add", 'documentreservation/new?document='.$document.'&country='.$country)
?>