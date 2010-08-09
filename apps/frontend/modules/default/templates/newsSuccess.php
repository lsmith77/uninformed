<?php

slot('title', 'News on resolutionfinder.org');
slot('description', 'News about resolutionfinder.org');
slot('robots', 'INDEX, FOLLOW');

?>

<h1>News on resolutionfinder.org</h1>

<div class="news">

<div class="contentBlock">

    <h2>Help us improve Resolutionfinder.org</h2>

    <p>To make the documents in our database even better accessible we would like your help!
    What is the best starting point for your search? Which filter options are crucial
    to give you the best results on ResolutionFinder? Let us know your opinion: test the database
    and take five minutes to fill out a <?php echo link_to('short survey', 'http://www.surveymonkey.com/s/B7BWBQ6') ?>.</p>

    <p>For comments and questions don't hesitate to contact us at
    <?php echo mail_to('feedback@resolutionfinder.org', 'feedback@resolutionfinder.org', 'encode=true', array('subject' => '[resolutionfinder.org]:', 'body' => "url:".$sf_context->getRequest()->getUri()."\n")); ?>.</p>
</div>

<br />

<div class="contentBlock">

    <h2>Coming soon: Most important UN documents on Desertification and Drought and Nuclear Proliferation</h2>

    <p>Resolutionfinder.org is expanding! After we brought you the most relevant operative clauses from the areas of
    Clean Drinking Water, Malaria, Small Arms and Light Weapons, and Women and Education, we decided it's high time we
    developed a couple more "hot topics".</p>

    <p>This time we decided to tackle Nuclear Proliferation and Desertification and Drought - two very different, yet equally
    controversial issues all around the world. You should be able to search for the relevant clauses by the end of the year!</p>

    <p>Until then, stay tuned, we're in the middle of an updating process of the current thematic areas with the clauses from
    the most recent UN documents in the field and we're also working on redesigning the interface. If you have any comments
    or suggestions regarding the content of the research or the website, contact us at
    <?php echo mail_to('feedback@resolutionfinder.org', 'feedback@resolutionfinder.org', 'encode=true', array('subject' => '[resolutionfinder.org]:', 'body' => "url:".$sf_context->getRequest()->getUri()."\n")); ?>.</p>
</div>

<br />

<div class="contentBlock">

    <h2>Access to Clean Water and Sanitation is Acknowledged as a Human Right by the General Assembly</h2>

    <p>The United Nations General Assembly declared on July 28th that access to safe and clean drinking water and sanitation
    represents a fundamental human right for the attainment of adequate living standards.</p>

    <p>According to the UN News Centre, the GA voiced deep concerns that approximately 900 million people all around the world
    lack access to clean drinking water, and called upon Member States and international organizations to provide funding
    and technology to the underdeveloped and developing countries in their efforts to make clean drinking water and
    sanitation accessible and affordable to everyone.</p>

    <p>122 countries voted in favor of this resolution, 41 abstained and there were no votes against it.</p>

    <p>Here you can <?php echo link_to('download', 'http://'.$sf_request->getHost().'/downloads/A_64_L.63_Rev.1.pdf'); ?>
    the draft resolution on "The human right to water and sanitation". The clauses of the resolution shall also be
    published on ResolutionFinder.org once the final version of the text is publicly available.</p>
</div>

<br />

</div>

<div>
    <h4>For current information follow us on twitter:</h4>
    <a href="http://www.twitter.com/resofinder"><img src="http://twitter-badges.s3.amazonaws.com/twitter-a.png" alt="Follow resofinder on Twitter"/></a>
</div>

