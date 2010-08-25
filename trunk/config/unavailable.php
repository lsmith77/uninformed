<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo sfConfig::get('sf_charset', 'utf-8') ?>" />
        <title>ResolutionFinder.org</title>
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />
        <meta name="title" content="ResolutionFinder.org" />
        <meta name="description" content="ResolutionFinder.org is a search engine that lets you find the relevant contents of UN Agreements on Clean Drinking Water, Malaria, Small Arms and Light Weapons and Women and Education in a fast and user-friendly way. More thematic areas will follow soon." />
        <meta name="keywords" content="United Nations, UN, Resolution, Convention, UN Agreement, UN System, Malaria, Roll Back Malaria, Water, Clean Drinking Water, SALW, Small Arms, Light Weapons, Women, Education, Women's Rights" />
        <meta name="language" content="en" />
        <meta name="robots" content="index, follow" />
    </head>
    <body>
        <div id="wrap">
            <h1>Website Temporarily Unavailable</h1>
            <?php $path = preg_replace('#/[^/]+\.php5?$#', '', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : '')) ?>

            <div class="homesearch">
                <div class="sfTContainer">
                  <div class="sfTMessageContainer sfTAlert">
                    <img alt="page not found" class="sfTMessageIcon" src="<?php echo $path ?>/sf/sf_default/images/icons/tools48.png" height="48" width="48" />
                    <div class="sfTMessageWrap">
                      <h5>Please try again in a few seconds...</h5>
                    </div>
                  </div>

                  <dl class="sfTMessageInfo">
                    <dt>What's next</dt>
                    <dd>
                      <ul class="sfTIconList">
                        <li class="sfTReloadMessage"><a href="javascript:window.location.reload()">Try again: Reload Page</a></li>
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
