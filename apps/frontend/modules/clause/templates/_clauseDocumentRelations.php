<table id="documentDocumentRelations" class="collapsed">
    <thead>
        <tr>
            <th>Document Code</th>
            <th>Year</th>
            <th>Relationship</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($related_documents as $relation): ?>
        <tr>
            <td>
                <?php echo link_to((string)$relation->DocumentRelated, 'document', array('id' => $relation->DocumentRelated->getSlug())); ?>
            </td>
            <td>
                <?php echo date('Y',strtotime($relation->DocumentRelated->getAdoptionDate())); ?>
            </td>
            <td>
                <?php echo $relation->getType(); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
