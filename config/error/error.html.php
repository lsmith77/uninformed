<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UN-informed.org</title>
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />
        <meta name="title" content="UN-informed.org" />
        <meta name="description" content="UN-informed.org is a project of MCM, providing a structured database for UN resolutions" />
        <meta name="keywords" content="UN, resolutions" />
        <meta name="language" content="en" />
        <meta name="robots" content="index, follow" />
    </head>
    <body>
        <div id="wrap">
            <h1>Oops! An Error Occurred</h1>
            <?php $path = preg_replace('#/[^/]+\.php5?$#', '', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : '')) ?>

            <div class="homesearch">
                <div class="sfTContainer">
                  <div class="sfTMessageContainer sfTAlert">
                    <img alt="page not found" class="sfTMessageIcon" src="<?php echo $path ?>/sf/sf_default/images/icons/tools48.png" height="48" width="48" />
                    <div class="sfTMessageWrap">
                      <h5>The server returned a "<?php echo $code ?> <?php echo $text ?>".</h5>
                    </div>
                  </div>

                  <dl class="sfTMessageInfo">
                    <dt>Something is broken</dt>
                    <dd>Please <a href="mailto:feedback@UN-informed.org">e-mail us</a> and let us know what you were doing when this error occurred. We will fix it as soon as possible.
                    Sorry for any inconvenience caused.</dd>

                    <dt>What's next</dt>
                    <dd>
                      <ul class="sfTIconList">
                        <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Back to previous page</a></li>
                        <li class="sfTLinkMessage"><a href="/">Go to Homepage</a></li>
                      </ul>
                    </dd>
                  </dl>
                </div>
            </div>
            <noscript><p class="noscript">This site runs *much* better with javascript enabled</p></noscript>
            <p class="support">Supported by <a href="http://liip.ch/" class="liip"><span>Liip AG - Agile web development - Zurich, Fribourg, Bern</span></a></p>
        </div>
    </body>
</html>
