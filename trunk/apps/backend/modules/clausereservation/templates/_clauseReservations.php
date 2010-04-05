<?php use_helper('jQuery'); ?>

<div id="clauseReservation">
  
  <?php echo jq_link_to_remote('Add clause reservation', array(
	    'update' => 'clauseReservation',
	    'url'    => 'clauseReservation/newFromVote?vote_id='.$vote
	)) ?>
  
</div>