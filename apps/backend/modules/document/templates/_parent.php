<?php if ($document->parent_document_id) echo link_to($document->Parent, @default_edit, array('module' => 'document', 'id' => $document->parent_document_id, 'action' => 'edit')); ?>