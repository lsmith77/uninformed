<h1>Login</h1>

<form id="signin_form" class="contentBlock" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="<?php echo 'Sign in' ?>" />
  <a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo 'Forgot your password?' ?></a>
</form>
