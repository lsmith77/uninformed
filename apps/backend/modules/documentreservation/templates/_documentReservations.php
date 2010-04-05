<?php use_helper('jQuery'); ?>

<div>
  <h1>Document Reservation</h1>
  <p id="reservationFeedback"><?php echo $myVar; ?></p>

  <?php echo jq_form_remote_tag(array(
	    'update'   => 'reservationFeedback',
	    'url'      => 'documentreservation/createFromVote',
	)) ?>

    <?php // echo tag('input', array('name' => 'country_id', 'type' => 'hidden', 'value' => '1')) ?>
    <?php // echo tag('input', array('name' => 'document_id', 'type' => 'hidden', 'value' => '1')) ?>
    <?php echo tag('input', array('name' => 'vote_id', 'type' => 'hidden', 'value' => $vote)) ?>

	  <?php echo content_tag('textarea',
	    '',
	    array('name' => 'reservationText', 'cols' => '80', 'rows' => '10'))
	  ?>
	  <?php echo tag('input', array('type' => 'submit')) ?>
	</form>

</div>
