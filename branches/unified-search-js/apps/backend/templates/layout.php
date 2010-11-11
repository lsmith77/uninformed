<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>resolutionfinder.org Admin Interface</title>
<link rel="shortcut icon" href="/favicon.ico" />
<?php include_javascripts() ?>
<?php include_stylesheets() ?>

</head>
<body>
<div id="container">
<div id="header">
<h1>
  <?php echo link_to(image_tag('/images/logo.gif', array('alt' => 'ResolutionFinder.org')), '@homepage'); ?>
</h1>
</div>

<?php include_component('sfAdminDash','header'); ?>
<div id="content"><?php echo $sf_content ?></div>
<?php include_partial('sfAdminDash/footer'); ?>

</div>
</body>
</html>
