<?php if ($document->parent_document_id) echo link_to($document->DocumentParent, '@default_edit?module=document&action=edit&id='.$document->parent_document_id); ?>
