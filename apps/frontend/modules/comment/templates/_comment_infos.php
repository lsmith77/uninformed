      <td rowspan="2" class="infos">
        <a name="<?php echo $i ?>" class="ancre">#<?php echo $i ?></a>
        <?php if(!$obj->is_delete): ?>
          <?php echo link_to_function(
                  image_tag('/vjCommentPlugin/images/comments.png') ,
                  "reply('".$obj->id."','".$obj->author_name."')",
                  array('title' => __('Reply to this comment', array(), 'vjComment'))) ?>
        <?php endif; ?>
        <?php if(commentTools::isGravatarAvailable() && !$obj->is_delete): ?>
          <?php echo gravatar_image_tag($obj->getAuthorEmail()) ?>
        <?php endif ?>
      </td>
