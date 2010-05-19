<table id="clauseClauseRelations" class="collapsed">
    <thead>
        <tr>
            <th>Clause Code</th>
            <th>Year</th>
            <th>Relationship</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($related_clauses as $relation): ?>
        <?php $clause = $relation->ClauseBody->setLatestAdoptedClause(); ?>
        <tr>
            <td>
                <?php echo link_to((string)$clause, 'document', array('id' => $clause->getSlug())); ?>
            </td>
            <td>
                <?php echo date('Y',strtotime($clause->Document->getAdoptionDate())); ?>
            </td>
            <td>
                <?php echo $relation->getType(); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
