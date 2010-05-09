<?php use_helper('jQuery'); ?>

<h3>Clause Reservation</h3>

<p id="clauseReservationFeedback">
</p>

<?php echo jq_form_remote_tag(array(
      'update'   => 'clauseReservationFeedback',
      'url'      => 'clausereservation/updateFromVote',
  )) ?>

  <?php echo tag('input', array('name' => 'reservation_id', 'type' => 'hidden', 'value' => $params['clauseReservation']['id'])) ?>
  
  <?php
  $options = "";
  
  foreach($params['clauses'] as $clause)
  {
      if($params['clauseReservation']['clause_body_id'] == $clause['clause_body_id'])
      {
          $options .= '<option selected="selected" value="'.$clause['clause_body_id'].'">'.$clause['slug'].'</option>';
      }
      else
      {
          $options .= '<option value="'.$clause['clause_body_id'].'">'.$clause['slug'].'</option>';
      }
  }
  ?>
  
  <div>
    <?php echo content_tag('select', $options, array('name' => 'clause_body_id')) ?>
  </div>
  
  <div>
	  <?php echo content_tag('textarea',
	    $params['clauseReservation']['reservation'],
	    array('name' => 'reservationText', 'cols' => '80', 'rows' => '10'))
	  ?>
  </div>
  
  <div>
    <?php echo tag('input', array('type' => 'submit')) ?>
  </div>
</form>