<!DOCTYPE html>
<html>
  <head>
    <?php use_helper('swCombine') ?>
    <?php include_http_metas() ?>

    <title><?php if (include_slot('title')): ?> - <?php endif ?>resolutionfinder.org - beta - The Search Engine for UN Agreements</title>

    <meta name="title" content="<?php include_slot('title', ' resolutionfinder.org - beta - The Search Engine for UN Agreements') ?>" />
    <meta name="description" content="<?php if (!include_slot('description')): ?>resolutionfinder.org is a search engine that lets you find the relevant contents of UN Agreements on Clean Drinking Water, Malaria, Small Arms and Light Weapons and Women and Education in a fast and user-friendly way. More thematic areas will follow soon.<?php endif ?>" />
    <meta name="keywords" content="<?php if (!include_slot('keywords')): ?>United Nations, UN, Resolution, Convention, UN Agreement, UN System, Malaria, Roll Back Malaria, Water, Clean Drinking Water, SALW, Small Arms, Light Weapons, Women, Education, Women&#039;s Rights<?php endif ?>" />
    <meta name="robots" content="<?php if (!include_slot('robots')): ?>NOINDEX; NOFOLLOW<?php endif ?>" />
    <meta name="language" content="en" />
    <meta name="google-site-verification" content="jgkRbNeGBKhvpBxmaLRenWNQ2ZD5nhaq6xTe3CjQ8EI" />
    <?php if (has_slot('canonical')) { ?>
        <link rel="canonical" href="<?php include_slot('canonical') ?>" />
    <?php } ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php sw_include_stylesheets() ?>
  </head>
  <body>
    <div id="wrap">
<?php if (strpos($sf_context->getRequest()->getUri(), 'http://resolutionfinder.org') === 0): ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16437566-3']);
  _gaq.push(['_setDomainName', '.resolutionfinder.org']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php endif; ?>
    <?php $route = sfContext::getInstance()->getRouting()->getCurrentRouteName(); ?>
    <div class="header">
      <span>resolutionfinder.org</span>
    </div>
    <div class="nav">
    <ul class="mnav">
      <li class="<?php if ($route === 'search' || $route === 'clauseSearch' || $route === 'homepage') { echo 'current'; } ?>"><?php echo link_to('Search', 'search'); ?></li>
<?php if ($sf_user->isAuthenticated() && $sf_user->hasCredential('admin')): ?>
      <li class="<?php if ($route === 'news') { echo 'current'; } ?>"><?php echo link_to('News', '@news'); ?></li>
    <?php endif; ?>
      <li class="<?php if ($route === 'aboutus') { echo 'current'; } ?>"><?php echo link_to('About', '@aboutus'); ?></li>
      <li><?php echo link_to('UN-i.org', 'http://www.UN-i.org'); ?></li>
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
        <li><?php echo mail_to('feedback@resolutionfinder.org', 'Feedback', 'encode=true', array('subject' => '[resolutionfinder.org]:', 'body' => "url:".$sf_context->getRequest()->getUri()."\n")); ?></li>
    </ul>
    </div>
    <?php if($sf_user->hasFlash('notice')): ?>
      <div id="flash_notice"><b>Notice:</b> <?php echo $sf_user->getFlash('notice'); ?></div>
    <?php endif; ?>
    <?php echo $sf_content ?>
    <noscript><p class="noscript">This site runs *much* better with javascript enabled</p></noscript>
    <p class="support">Supported by <a href="http://liip.ch/" class="liip"><span>Liip AG - Agile web development - Zurich, Fribourg, Bern</span></a></p>
    </div>
<?php sw_include_javascripts() ?>
  </body>
</html>
