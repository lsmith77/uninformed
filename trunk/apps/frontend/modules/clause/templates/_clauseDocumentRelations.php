<table id="clauseDocumentRelations" class="collapsed">
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
                <?php echo link_to((string)$relation->Document, 'document', array('id' => $relation->Document->getSlug())); ?>
            </td>
            <td>
                <?php echo $relation->Document->getAdoptionYear(); ?>
            </td>
            <td>
                <?php echo $relation->getType(); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
