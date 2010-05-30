<table id="documentClauseRelations" class="collapsed closed">
    <thead>
        <tr>
            <th>Clause Code</th>
            <th>Year</th>
            <th>Relationship</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($related_clauses as $relation): ?>
        <?php $clause = $relation->ClauseRelated->getLatestAdoptedClause(); ?>
        <tr>
            <td>
                <?php echo link_to((string)$clause, 'clause', array('id' => $clause->getSlug())); ?>
            </td>
            <td>
                <?php echo $clause->Document->getAdoptionYear(); ?>
            </td>
            <td>
                <?php echo $relation->getType(); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
