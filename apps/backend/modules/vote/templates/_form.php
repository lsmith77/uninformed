<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery'); ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@vote') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('vote/form_fieldset', array('vote' => $vote, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('vote/form_actions', array('vote' => $vote, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
  
  <?php
  
  /*
   * Display links to reservations only in Edit mode
   */  
  if(!$form->isNew() && $vote->getType() == "ratified")
  {
    include_component('documentreservation', 'documentReservations', array('vote' => $vote));
    include_component('clausereservation', 'clauseReservations', array('vote' => $vote));
  }
  ?>
  
</div>

<script type="text/javascript">
//<![CDATA[
jQuery('#vote_document_id').change(function()
{
    /*jQuery.ajax({type:'POST',dataType:'html',success:function(data, textStatus){jQuery('#vote_country_id').html(data);},url:'/backend_dev.php/country/retrieveApplicableCountries/document_id/'+this.value});*/
    jQuery.ajax({type:'POST',dataType:'html',success:function(data, textStatus){jQuery('#vote_type').html(data);},url:'/backend_dev.php/vote/retrieveApplicableDecisionTypes/document_id/'+this.value});
});
//]]>
</script>