<div class="homesearch">
<div class="sfTMessageContainer sfTAlert">
  <?php echo image_tag('/sf/sf_default/images/icons/cancel48.png', array('alt' => 'page not found', 'class' => 'sfTMessageIcon', 'size' => '48x48')) ?>
  <div class="sfTMessageWrap">
    <h1>The page could not  be found</h1>
    <h5>The server returned a 404 response.</h5>
  </div>
</div>
<dl class="sfTMessageInfo">
  <p>
    <dt>Did you type the URL?</dt>
    <dd>You may have typed the address (URL) incorrectly. Check it to make sure you've got the exact right spelling, capitalization, etc.</dd>
  </p>

  <p>
    <dt>Did you follow a link from somewhere else at this site?</dt>
    <dd>If you reached this page from another part of this site, please <?php echo mail_to('feedback@UN-informed.org', 'email us', 'encode=true', array('subject' => '[UN-informed.org]:', 'body' => "url:".$sf_context->getRequest()->getUri()."\n")); ?> so we can correct our mistake.</dd>
  </p>

  <p>
    <dt>Did you follow a link from another site?</dt>
    <dd>Links from other sites can sometimes be outdated or misspelled. Please <?php echo mail_to('feedback@UN-informed.org', 'email us', 'encode=true', array('subject' => '[UN-informed.org]:', 'body' => "url:".$sf_context->getRequest()->getUri()."\n")); ?> where you came from and we can try to contact the other site in order to fix the problem.</dd>
  </p>

  <p>
    <dt>What's next:</dt>
    <dd>
      <ul class="sfTIconList">
        <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Back to previous page</a></li>
        <li class="sfTLinkMessage"><?php echo link_to('Go to Homepage', '@homepage') ?></li>
      </ul>
    </dd>
  </p>
</dl>
</div>
