<?php use_helper('jQuery'); ?>

<h3>Document Reservation</h3>

<p id="documentReservationFeedback">
</p>

<?php echo jq_form_remote_tag(array(
      'update'   => 'documentReservationFeedback',
      'url'      => 'documentreservation/createFromVote',
  )) ?>

  <?php echo tag('input', array('name' => 'country_id', 'type' => 'hidden', 'value' => $params['country_id'])) ?>
  <?php echo tag('input', array('name' => 'document_id', 'type' => 'hidden', 'value' => $params['document_id'])) ?>

  <div>
	  <?php echo content_tag('textarea',
	    '',
	    array('name' => 'reservationText', 'cols' => '80', 'rows' => '10'))
	  ?>
  </div>
  <div>
    <?php echo tag('input', array('type' => 'submit')) ?>
  </div>
</form>