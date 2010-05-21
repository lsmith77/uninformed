<?php

if($vote->getType() == "ratified")
{
	/*$document = $vote->getDocument();
	$country = $vote->getCountry();*/
	
	echo link_to("Add", 'documentreservation/newFromVote?vote='.$vote->getId());
}
else
{
	echo "n/a";
}
?>