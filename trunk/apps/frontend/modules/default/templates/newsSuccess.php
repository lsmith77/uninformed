<?php

slot('title', 'News on ResolutionFinder.org');
slot('description', 'News about ResolutionFinder.org');
slot('robots', 'INDEX, FOLLOW');

?>

<h1>News on ResolutionFinder.org</h1>

<div class="news">

<div id="accordion">

<h3><a href="#">Jungle Drum and ISN announce cooperation to further develop ResolutionFinder.org</a></h3>
<div>
    <p><?php echo link_to('Jungle Drum', 'http://jngldrm.org'); ?> and the Swiss-based
    <?php echo link_to('International Relations and Security Network (ISN)', 'http://www.isn.ethz.ch'); ?> have started
    to discuss the terms of a cooperation for the improvement and development of the ResolutionFinder.org database.</p>

    <p>After two years of hard work during which Jungle Drum managed to elaborate a methodology and have a beta version
    of the database up and running, it was high time to speed up the development process and take things to a new level.</p>

    <p>Representatives from Jungle Drum and the ISN met in Berlin in mid-September for a first round of discussions about
    the cooperation and the developments over the next two years. Over this period they will work on building an
    intelligent text mining tool (iTMT) to automatize a significant amount of work that is currently done manually.
    The aim is to acquire this iTMT within one year and dedicate the next year to the development of 16 new thematic
    issues for the database. The issues will be selected from the four areas that are currently in the beta version -
    security, health, human rights and environment. The first phase of the partnership is expected to be concluded
    before the end of the year with the official cooperation commencing in 2011.</p>

    <p>The International Relations and Security Network (ISN) is an online project of the Center for Security Studies
    (CSS), at the Swiss Federal Institute of Technology (ETH Zurich). It provides the world's leading open access
    information service for international relations and security professionals and has been working towards the
    promotion of greater knowledge sharing, learning and collaboration for 16 years now. For more information, see
    the <?php echo link_to('ISN website', 'http://www.isn.ethz.ch/isn/About-Us/Who-we-are'); ?>.</p>
</div>

<h3><a href="#">Help us improve ResolutionFinder.org</a></h3>
<div>
    <p>To make the documents in our database even better accessible we would like your help!
    What is the best starting point for your search? Which filter options are crucial
    to give you the best results on ResolutionFinder? Let us know your opinion: test the database
    and take five minutes to fill out a <?php echo link_to('short survey', 'http://www.surveymonkey.com/s/B7BWBQ6') ?>.</p>

    <p>For comments and questions don't hesitate to contact us at
    <?php echo mail_to('feedback@resolutionfinder.org', 'feedback@resolutionfinder.org', 'encode=true', array('subject' => '[ResolutionFinder.org]:', 'body' => "url:".$sf_context->getRequest()->getUri()."\n")); ?>.</p>
</div>

<h3><a href="#">Coming soon: Most important UN documents on Desertification and Drought and Nuclear Proliferation</a></h3>
<div>
    <p>ResolutionFinder.org is expanding! After we brought you the most relevant operative clauses from the areas of
    Clean Drinking Water, Malaria, Small Arms and Light Weapons, and Women and Education, we decided it's high time we
    developed a couple more "hot topics".</p>

    <p>This time we decided to tackle Nuclear Proliferation and Desertification and Drought - two very different, yet equally
    controversial issues all around the world. You should be able to search for the relevant clauses by the end of the year!</p>

    <p>Until then, stay tuned, we're in the middle of an updating process of the current thematic areas with the clauses from
    the most recent UN documents in the field and we're also working on redesigning the interface. If you have any comments
    or suggestions regarding the content of the research or the website, contact us at
    <?php echo mail_to('feedback@resolutionfinder.org', 'feedback@resolutionfinder.org', 'encode=true', array('subject' => '[ResolutionFinder.org]:', 'body' => "url:".$sf_context->getRequest()->getUri()."\n")); ?>.</p>
</div>

<h3><a href="#">Access to Clean Water and Sanitation is Acknowledged as a Human Right by the General Assembly</a></h3>
<div>
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

</div>

</div>

<br />

<div>
    <h4>For current information follow us on twitter:</h4>
    <a href="http://www.twitter.com/resofinder"><img src="http://twitter-badges.s3.amazonaws.com/twitter-a.png" alt="Follow resofinder on Twitter"/></a>
</div>

