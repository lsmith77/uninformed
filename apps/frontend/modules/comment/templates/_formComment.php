<?php use_helper('I18N', 'JavascriptBase') ?>
<?php $sf_user->setAttribute('nextComment', $object->getNbComments()+1) ?>
<a name="top"></a>
<div class="form-comment">
<?php if( vjComment::checkAccessToForm() ): ?>
  <?php if (!empty($form->comment_saved)): ?>
    <?php use_helper('I18N') ?>
    <div><h1><?php echo __('Saved post successfully, it will appear once its moderated', array(), 'vjComment') ?></h1></div>
  <?php endif ?>
  <form action="" method="post">
  <fieldset>
    <legend><?php echo __('Add new comment', array(), 'vjComment') ?></legend>
    <br />
    <em><?php echo __('All comments require manual moderation before they appear', array(), 'vjComment') ?></em>
    <?php include_partial("comment/form", array('form' => $form)) ?>
    <tr>
      <td colspan="2" class="submit">
        <input type="submit" value="<?php echo __('send', array(), 'vjComment') ?>" class="submit" />
      </td>
    </tr>
  </table>
  </fieldset>
  </form>
<?php else: ?>
  <div id="" style="text-align: center;"><strong><?php echo __('Please log in to comment.', array(), 'vjComment') ?></strong></div>
<?php endif ?>
</div>
