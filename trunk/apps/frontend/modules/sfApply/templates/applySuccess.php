<?php
  // Override the login slot so that we don't get a login prompt on the
  // apply page, which is just odd-looking. 0.6
?>
<?php slot('sf_apply_login') ?>
<?php end_slot() ?>
<div class="sf_apply sf_apply_apply">
<h1><?php echo "Subscribe" ?></h1>
<form method="POST" action="<?php echo url_for('sfApply/apply') ?>" name="sf_apply_apply_form" class="contentBlock" id="sf_apply_apply_form">
<ul>
<?php echo $form ?>
<li class="sf_apply_submit_row">
<label></label>
<input type="submit" value="<?php echo "Create My Account" ?>" />
</li>
</ul>
</form>
</div>
