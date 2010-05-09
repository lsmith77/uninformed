<?php use_helper('jQuery'); ?>

<div id="clauseReservation">

  <h3>Clause Reservations</h3>

  <?php
    if(count($clauseReservations) > 0)
    {
        echo "<ul>";

        foreach($clauseReservations as $clauseReservation)
        {
            echo "<li>";
            echo $clauseReservation['clause_number']."-".$clauseReservation['reservation'];
            echo jq_link_to_remote('Edit', array(
                'update' => 'clauseReservation',
                'url'    => 'clauseReservation/editFromVote?reservation_id='.$clauseReservation['id'].'&document_id='.$vote['document_id']
            ));
            echo "</li>";
        }

        echo "</ul>";
    }
  ?>
  
  <?php echo jq_link_to_remote('Add clause reservation', array(
	    'update' => 'clauseReservation',
	    'url'    => 'clauseReservation/newFromVote?vote_id='.$vote
	)) ?>
  
</div>