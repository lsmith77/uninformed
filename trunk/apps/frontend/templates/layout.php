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
    <div class="header">
      <span>un-informed.org - making commitments matter</span>
    </div>
    <ul class="nav">
      <li><?php echo link_to('Search', 'search'); ?></li>
      <li><?php echo link_to('UN-i.org', 'un_i_info'); ?></li>
      <li><?php echo link_to('About', 'about'); ?></li>
    </ul>
    <noscript><p class="noscript">This site runs *much* better with javascript enabled</div></noscript>
    <?php echo $sf_content ?>
  </body>
</html>
