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
    <div id="wrap">
<?php if (strpos($sf_context->getRequest()->getUri(), 'http://search.un-informed.org') === 0): ?>
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
<?php endif; ?>
    <?php $route = sfContext::getInstance()->getRouting()->getCurrentRouteName(); ?>
    <div class="header">
      <span>UN-informed.org - making commitments matter</span>
    </div>
    <div class="nav">
    <ul class="mnav">
      <li class="<?php if ($route === 'search' || $route === 'clauseSearch' || $route === 'homepage') { echo 'current'; } ?>"><?php echo link_to('Search', 'search'); ?></li>
      <li><?php echo link_to('UN-i.org', 'http://www.UN-i.org'); ?></li>
      <li><?php echo link_to('About', 'http://www.UN-informed.org'); ?></li>
    </ul>
    <ul class="snav">
<?php if ($sf_user->isAuthenticated()): ?>
      <li class="<?php if ($route === 'bookmark') { echo 'current'; } ?>"><?php echo link_to('Bookmarks', 'bookmark'); ?></li>
      <li class="<?php if ($route === 'settings') { echo 'current'; } ?>"><?php echo link_to('Settings', 'settings'); ?></li>
      <li class="<?php if ($route === 'sf_guard_signout') { echo 'current'; } ?>"><?php echo link_to('Logout', 'sf_guard_signout'); ?></li>
<?php else: ?>
      <li class="<?php if ($route === 'sf_guard_signin') { echo 'current'; } ?>"><?php echo link_to('Login', 'sf_guard_signin'); ?></li>
      <li class="<?php if ($route === 'apply') { echo 'current'; } ?>"><?php echo link_to('Register', 'apply'); ?></li>
<?php endif; ?>
        <li><?php echo mail_to('feedback@UN-informed.org', 'Feedback', 'encode=true', array('subject' => '[UN-informed.org]:', 'body' => "url:".$sf_context->getRequest()->getUri()."\n")); ?></li>
    </ul>
    </div>
    <?php if($sf_user->hasFlash('notice')): ?>
      <div id="flash_notice"><b>Notice:</b> <?php echo $sf_user->getFlash('notice'); ?></div>
    <?php endif; ?>
    <?php echo $sf_content ?>
    <noscript><p class="noscript">This site runs *much* better with javascript enabled</p></noscript>
    <p class="support">Supported by <a href="http://liip.ch/" class="liip"><span>Liip AG - Agile web development - Zurich, Fribourg, Bern</span></a></p>
    </div>
  </body>
</html>
