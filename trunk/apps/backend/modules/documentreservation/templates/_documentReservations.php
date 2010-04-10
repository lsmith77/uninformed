<?php use_helper('jQuery'); ?>

<div id="documentReservation">
  
  <?php echo jq_link_to_remote('Add document reservation', array(
      'update' => 'documentReservation',
      'url'    => 'documentReservation/newFromVote?vote_id='.$vote
  )) ?>
  
</div>