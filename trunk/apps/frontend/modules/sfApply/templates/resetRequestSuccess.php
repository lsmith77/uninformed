<?php slot('sf_apply_login') ?>
<?php end_slot() ?>
<h1>Password recovery</h1>
<div class="sf_apply sf_apply_reset_request contentBlock">
<form method="POST" action="<?php echo url_for('sfApply/resetRequest') ?>"
  name="sf_apply_reset_request" id="sf_apply_reset_request">
<p>
Enter your username <strong>or</strong> email address and click "Reset My Password."
</p>
<p>
You will then receive an email containing both your username and a link allowing you to change your password.
</p>
<ul>
<?php echo $form ?>
<li>
<input type="submit" value="<?php echo "Reset My Password" ?>">
<?php echo "or " ?>
<?php echo link_to('Cancel', sfConfig::get('app_sfApplyPlugin_after', '@homepage')) ?>
</li>
</ul>
</form>
</div>
