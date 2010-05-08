<?php use_helper('jQuery'); ?>

<h3>Document Reservation</h3>

<p id="documentReservationFeedback">
</p>

<?php echo jq_form_remote_tag(array(
      'update'   => 'documentReservationFeedback',
      'url'      => 'documentreservation/updateFromVote',
  )) ?>

  <?php echo tag('input', array('name' => 'reservation_id', 'type' => 'hidden', 'value' => $params['reservation'])) ?>

  <div>
	  <?php echo content_tag('textarea',
	    $params['reservationText'],
	    array('name' => 'reservationText', 'cols' => '80', 'rows' => '10'))
	  ?>
  </div>
  <div>
    <?php echo tag('input', array('type' => 'submit')) ?>
  </div>
</form>