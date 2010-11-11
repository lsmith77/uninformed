<?php slot('sf_apply_login') ?>
<?php end_slot() ?>
<div class="sf_apply sf_apply_settings">
<h1><?php echo "Account Settings" ?></h1>
<div class="contentBlock">
<form method="POST" action="<?php echo url_for("sfApply/settings") ?>" name="sf_apply_settings_form" id="sf_apply_settings_form">
<ul>
<?php echo $form ?>
<li>
<input type="submit" value="<?php echo "Save" ?>" /> <?php echo "or " ?>
<?php echo link_to('Cancel', sfConfig::get('app_sfApplyPlugin_after', '@homepage')) ?>
</li>
</ul>
</form>
<br />
<form method="GET" action="<?php echo url_for("sfApply/resetRequest") ?>" name="sf_apply_reset_request" id="sf_apply_reset_request">
<p>
<?php echo <<<EOM
Click the button below to change your password. For security reasons, you
will receive a confirmation email containing a link allowing you to complete
the password change.
EOM
 ?>
</p>
<input type="submit" value="<?php echo "Reset Password" ?>" />
</form>
</div>
</div>
