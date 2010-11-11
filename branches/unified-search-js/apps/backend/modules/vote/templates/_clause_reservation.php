<?php

if($vote->getType() == "ratified")
{
  $document = $vote->getDocument();
  $country = $vote->getCountry();
  
  echo link_to("Add", 'clausereservation/new?document='.$document.'&country='.$country);
}
else
{
  echo "n/a";
}
?>