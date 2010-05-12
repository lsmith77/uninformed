<?php echo $clause ?>
<br />

<h2>Content</h2>
<div><?php echo $clauseBody->getContent() ?></div>

<h2>Clause Details</h2>
<table>
    <thead>
        <tr>
            <th>Clause Number</th>
            <th>Operative Phrase</th>
            <th>Type of Information</th>
            <th>Addresses</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $clause->clause_number; ?></td>
            <td><?php echo $clauseBody->ClauseOperativePhrase; ?></td>
            <td><?php echo $clauseBody->ClauseInformationType; ?></td>
            <td>
            <?php foreach($clauseBody->Addressees as $address): ?>
            <?php echo $address->getName(); ?><br />
            <?php endforeach; ?>
            </td>
        </tr>
    </tbody>
</table>


<h2>Applied Keyword Tags</h2>
<div>
    <?php foreach($clauseBody->Tags as $tag): ?>
    <?php //TODO: change link url! ?>
    <?php echo link_to($tag->getName(), $clause); ?>
    <?php endforeach; ?>
</div>


<h2>History of this Clause</h2>
<table>
    <thead>
        <tr>
            <th>Year</th>
            <th>Changes</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>


<h2>Other Clauses in this Document</h2>
<?php include_partial('clauseListOfDocument', array('clauses' => $document->getClauses(), 'currentClause' => $clause)) ?>