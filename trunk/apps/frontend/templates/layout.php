<!DOCTYPE html>
<html>
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <?php if($sf_user->hasFlash('notice')): ?>
      <div id="flash_notice"><b>Notice:</b> <?php echo $sf_user->getFlash('notice'); ?></div>
    <?php endif; ?>
    <div class="header">
      <span>un-informed.org - making commitments matter</span>
    </div>
    <ul class="nav">
      <li><?php echo link_to('Search', 'search'); ?></li>
      <li><?php echo link_to('UN-i.org', 'un_i_info'); ?></li>
      <li><?php echo link_to('About', 'about'); ?></li>
<?php if ($sf_user->isAuthenticated()): ?>
      <li><?php echo link_to('Bookmarks', 'bookmark'); ?></li>
      <li><?php echo link_to('Settings', 'settings'); ?></li>
      <li><?php echo link_to('Logout', 'sf_guard_signout'); ?></li>
<?php else: ?>
      <li><?php echo link_to('Login', 'sf_guard_signin'); ?></li>
      <li><?php echo link_to('Register', 'apply'); ?></li>
<?php endif; ?>
    </ul>
    <noscript><p class="noscript">This site runs *much* better with javascript enabled</p></noscript>
    <?php echo $sf_content ?>
  </body>
</html>
