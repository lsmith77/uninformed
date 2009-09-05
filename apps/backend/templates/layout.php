<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>un-informed.org Admin Interface</title>
<link rel="shortcut icon" href="/favicon.ico" />
<?php use_stylesheet('admin.css') ?>
<?php include_javascripts() ?>
<?php include_stylesheets() ?>

</head>
<body>
<div id="container">
<div id="header">
<h1><a href="<?php echo url_for('@homepage') ?>"> <img
  src="/images/logo.gif"
  alt="un-informed.org - making commitments matter" /> </a></h1>
</div>

<div id="menu">
<ul>
  <li><?php echo link_to('Addressees', '@addressee_addressees') ?></li>
  <li><?php echo link_to('Legal Values', '@legalvalue_legalvalues') ?></li>
  <li>|</li>
  <li><?php echo link_to('Document Types', '@documenttype_documenttypes') ?>
  </li>
  <li><?php echo link_to('Tags', '@tag_tags') ?></li>
  <li><?php echo link_to('Tag Implications', '@tagimplication_tagimplications') ?>
  </li>
  <li><?php echo link_to('Tag Hierarchies', '@taghierarchie_taghierarchies') ?>
  </li>
  <li><?php echo link_to('Documents', '@document_documents') ?></li>
  <li><?php echo link_to('Document Relations', '@documentrelation_documentrelations') ?>
  </li>
  <li><?php echo link_to('Clauses', '@clause_clauses') ?></li>
  <li>|</li>
  <li><?php echo link_to('Member States', '@memberstate_memberstates') ?>
  </li>
  <li><?php echo link_to('Organisations', '@organisation_organisations') ?>
  </li>
  <li><?php echo link_to('Memberstates in Organisations', '@memberstateorganisation_memberstatesorganisations') ?>
  </li>
  <li>|</li>
  <li><?php echo link_to('Votes', '@vote_votes') ?></li>
</ul>
</div>

<div id="content"><?php echo $sf_content ?></div>
</div>
</body>
</html>
