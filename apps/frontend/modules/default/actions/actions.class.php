<?php

/**
 * default actions.
 *
 * @package    symfony
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
    /**
     * Error page for page not found (404) error
     *
     */
    public function executeError404()
    {
//throw new sfException('Testing the 500 error');
    }

#    public function executeAboutus(sfWebRequest $request)
#    {
#    }
}
