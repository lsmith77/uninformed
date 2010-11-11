<?php use_helper('jQuery'); ?>

<h3>Clause Reservation</h3>

<p id="clauseReservationFeedback">
</p>

<?php echo jq_form_remote_tag(array(
      'update'   => 'clauseReservationFeedback',
      'url'      => 'clausereservation/createFromVote',
  )) ?>

  <?php echo tag('input', array('name' => 'country_id', 'type' => 'hidden', 'value' => $params['country_id'])) ?>
  <?php echo tag('input', array('name' => 'document_id', 'type' => 'hidden', 'value' => $params['document_id'])) ?>
  
  <?php
  $options = "";
  
  foreach($params['clauses'] as $clause)
  {
    $options .= '<option value="'.$clause['clause_body_id'].'">'.$clause['slug'].'</option>';
  }
  ?>
  
  <div>
    <?php echo content_tag('select', $options, array('name' => 'clause_body_id')) ?>
  </div>
  
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