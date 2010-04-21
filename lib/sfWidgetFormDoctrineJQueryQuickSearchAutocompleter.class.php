<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormDoctrineJQueryQuickSearchAutocompleter represents an autocompleter input widget rendered by JQuery
 * optimized for foreign key lookup, that will load a new page with the selected item
 *
 * This implementation is based on sfWidgetFormPropelJQueryAutocompleter/sfWidgetFormDoctrineJQueryQuickSearchAutocompleter.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Lukas Smith <smith@pooteeweet.org>
 */
class sfWidgetFormDoctrineJQueryQuickSearchAutocompleter extends sfWidgetFormDoctrineJQueryAutocompleter
{
    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
      $url = url_for('@default_edit?module='.strtolower($this->getOption('model')).'&action=edit&id=XXX');
      $widget = parent::render($name, '', $attributes, $errors);
      $widget = str_replace('.val(data[1]);', ".val(data[1]); if (data[1].replace(/ /, '') !== '') { url = '$url'; location.href = url.replace(/XXX/, data[1]); }", $widget);
      return $widget;
    }
}
