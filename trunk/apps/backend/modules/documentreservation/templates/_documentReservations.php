<?php use_helper('jQuery'); ?>

<?php
$documentReservation = $vote->retrieveDocumentReservation();
?>

<div id="documentReservation">

  <?php
  if($documentReservation != Null)
  {
    echo "<p>".$documentReservation->getReservation()."</p>";
    echo jq_link_to_remote('Edit document reservation', array(
      'update' => 'documentReservation',
      'url'    => 'documentReservation/editFromVote?reservation_id='.$documentReservation->getId()
    ));
  }
  else
  {
    echo jq_link_to_remote('Add document reservation', array(
      'update' => 'documentReservation',
      'url'    => 'documentReservation/newFromVote?vote='.$vote
    ));
  }
  ?>

</div>