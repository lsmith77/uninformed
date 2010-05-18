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
<script type="text/javascript">

 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', 'UA-16437566-1']);
 _gaq.push(['_trackPageview']);

 (function() {
   var ga = document.createElement('script'); ga.type =
'text/javascript'; ga.async = true;
   ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
   var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
 })();

</script>
    <?php if($sf_user->hasFlash('notice')): ?>
      <div id="flash_notice"><b>Notice:</b> <?php echo $sf_user->getFlash('notice'); ?></div>
    <?php endif; ?>
    <div class="header">
      <span>un-informed.org - making commitments matter</span>
    </div>
    <ul class="nav">
      <li><?php echo link_to('Search', 'search'); ?></li>
      <li><?php echo link_to('UN-i.org', 'http://www.un-i.org'); ?></li>
      <li><?php echo link_to('About', 'about'); ?></li>
<?php if ($sf_user->isAuthenticated()): ?>
      <li><?php echo link_to('Bookmarks', 'bookmark'); ?></li>
      <li><?php echo link_to('Settings', 'settings'); ?></li>
      <li><?php echo link_to('Logout', 'sf_guard_signout'); ?></li>
<?php else: ?>
      <li><?php echo link_to('Login', 'sf_guard_signin'); ?></li>
      <li><?php echo link_to('Register', 'apply'); ?></li>
<?php endif; ?>
        <li><?php echo mail_to('info@un-informed.org', 'Feedback', 'encode=true', array('subject' => '[un-informed.org]:', 'body' => "url:".$sf_context->getRequest()->getUri()."\n")); ?></li>
    </ul>
    <noscript><p class="noscript">This site runs *much* better with javascript enabled</p></noscript>
    <?php echo $sf_content ?>
  </body>
</html>
