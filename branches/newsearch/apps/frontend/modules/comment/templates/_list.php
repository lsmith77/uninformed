<?php if($object->hasComments()): ?>
  <?php use_helper('Date', 'JavascriptBase', 'I18N') ?>
  <?php use_javascript("/vjCommentPlugin/js/reply.min.js") ?>
  <?php if(commentTools::isGravatarAvailable()): ?>
    <?php use_helper('Gravatar') ?>
  <?php endif ?>
  <br />
  <div class="form-comment"><h1><?php echo __('List of comments', array(), 'vjComment') ?></h1></div>
  <table class="list-comments">
  <?php foreach($object->getAllComments() as $c): ?>
    <?php include_partial("comment/comment", array('obj' => $c, 'i' => ++$i)) ?>
  <?php endforeach; ?>
  </table>
<?php endif ?>
