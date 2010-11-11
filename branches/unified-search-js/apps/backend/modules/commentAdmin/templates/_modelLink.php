<?php
$model = Doctrine_Core::getTable($comment->record_model)->find($comment->record_id);
if ($model) {
    echo link_to_frontend($model, strtolower($comment->record_model), array('id' => $model->getSlug()));
} else {
    echo 'Model '.$comment->record_model.' not available: '.$comment->record_id;
}
?>
