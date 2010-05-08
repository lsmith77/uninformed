<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('clause/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('clause/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'clause/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['document_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['document_id']->renderError() ?>
          <?php echo $form['document_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['clause_body_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['clause_body_id']->renderError() ?>
          <?php echo $form['clause_body_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['clause_number']->renderLabel() ?></th>
        <td>
          <?php echo $form['clause_number']->renderError() ?>
          <?php echo $form['clause_number'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['clause_number_information']->renderLabel() ?></th>
        <td>
          <?php echo $form['clause_number_information']->renderError() ?>
          <?php echo $form['clause_number_information'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['clause_number_subparagraph']->renderLabel() ?></th>
        <td>
          <?php echo $form['clause_number_subparagraph']->renderError() ?>
          <?php echo $form['clause_number_subparagraph'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['private_comment']->renderLabel() ?></th>
        <td>
          <?php echo $form['private_comment']->renderError() ?>
          <?php echo $form['private_comment'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['author_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['author_id']->renderError() ?>
          <?php echo $form['author_id'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
