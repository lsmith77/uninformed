<?php use_javascript('frontend/collapseBoxes.js'); ?>

<h2><a href="#" class="toggleCol" target="docDetails">Document details</a></h2>
<table id="docDetails">
    <thead>
        <tr>
            <th>Document Code</th>
            <th>Date of Adoption</th>
            <th>Organisation</th>
            <th>Main Organ</th>
            <th>Sub-Organ</th>
            <th>Legal Value</th>
            <th>Type of Document</th>
        </tr>
    </thead>
    <tbody>Hilfsfunktion on Document->getOrgan() getMainOrgan() getSubOrgan()
        <tr>
            <td><?php echo $document->code; ?></td>
            <td><?php echo $document->adoption_date; ?></td>
            <td><?php echo $document->Organisation; ?></td>
            <td><?php echo $document->getMainOrgan(); ?></td>
            <td><?php echo $document->Organisation->getSuborganisations(); ?></td>
            <td></td>
            <td><?php echo $document->DocumentType; ?></td>
        </tr>
    </tbody>
</table>

<h2>Voting</h2>
<h2>Applied Keyword Tags</h2>

<h2><a href="#" class="toggleCol" target="clauses">Clauses in this Document</a></h2>
<div id="clauses">
    <?php include_partial('clause/clauseListOfDocument', array('clauses' => $document->getClauses())) ?>
</div>
