<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) Jonathan H. Wage <jonwage@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormDoctrineJQueryChoiceAutocompleter represents a choice widget for a model that is optimized for large choice lists.
 *
 * @package    symfony
 * @subpackage doctrine
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @author     Lukas Kahwe Smith <smith@pooteeweet.org>
 */
class sfWidgetFormDoctrineJQueryChoiceAutocompleter extends sfWidgetFormDoctrineChoice
{
    protected $value = array();

    protected function configure($options = array(), $attributes = array())
    {
      $this->addRequiredOption('url');
      $this->addOption('module');

      parent::configure($options, $attributes);
    }

    public function getChoices()
    {
      if (empty($this->value)) {
          return array();
      }

      $choices = array();
      if (false !== $this->getOption('add_empty'))
      {
        $choices[''] = true === $this->getOption('add_empty') ? '' : $this->getOption('add_empty');
      }

      if (null === $this->getOption('table_method'))
      {
        $query = null === $this->getOption('query') ? Doctrine_Core::getTable($this->getOption('model'))->createQuery() : $this->getOption('query');
        if ($order = $this->getOption('order_by'))
        {
          $query->addOrderBy($order[0] . ' ' . $order[1]);
        }
        $query->whereIn($this->getOption('model').'.id', $this->value);
        $objects = $query->execute();
      }
      else
      {
        $tableMethod = $this->getOption('table_method');
        $results = Doctrine_Core::getTable($this->getOption('model'))->$tableMethod();
        $results->whereIn($this->getOption('model').'.id', $this->value);

        if ($results instanceof Doctrine_Query)
        {
          $objects = $results->execute();
        }
        else if ($results instanceof Doctrine_Collection)
        {
          $objects = $results;
        }
        else if ($results instanceof Doctrine_Record)
        {
          $objects = new Doctrine_Collection($this->getOption('model'));
          $objects[] = $results;
        }
        else
        {
          $objects = array();
        }
      }

      $method = $this->getOption('method');
      $keyMethod = $this->getOption('key_method');
      foreach ($objects as $object)
      {
        $choices[$object->$keyMethod()] = $object->$method();
      }

      return $choices;
    }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $this->value = $value;

    $html = '';
    if ($this->getOption('multiple'))
    {
      $attributes['multiple'] = 'multiple';

      if ('[]' != substr($name, -2))
      {
        $name .= '[]';
      }
      $html = '<br />'.parent::render($name, $value, $attributes, $errors);
      $value = null;
    }

    $autocompleter = new sfWidgetFormDoctrineJQueryAutocompleter(
        array(
          'model' => $this->getOption('model'),
          'url'   => $this->getOption('url'),
        )
      );
    $autocompleter = $autocompleter->render($name, $value);

    $edit = '';
    if ($this->getOption('multiple'))
    {
        // fix trailing _ due to value being an empty string out of toString()
        $autocompleter = str_replace(
            'autocomplete_'.$this->generateId($name).'_',
            'autocomplete_'.$this->generateId($name),
            $autocompleter
        );

        // remove hidden
        $autocompleter = preg_replace(
            '/^[^>]+>(.*)/',
            '$1',
            $autocompleter
        );

        // adjust action on result selection
        $autocompleter = str_replace(
            'jQuery("#'.$this->generateId($name).'").val(data[1]);',
            'if (data[1] > 0) { var dest = document.getElementById("'.$this->generateId($name).'"); dest.options[dest.length] = new Option(data[0], data[1]); }',
            $autocompleter
        );
    } elseif ($this->getOption('module')) {
        $edit = '&nbsp;<a href="#" onclick="url = \''
            .url_for($this->getOption('module').'_edit', array('id' => 'XXX'))
            .'\'; window.open(url.replace(\'XXX\', jQuery(\'#'
            .$this->generateId($name).'\').val())); return false;">'
            .__('Edit', array(), 'sf_admin');
    }

    return '<strong>Search</strong>: '.$autocompleter.$html.$edit;
  }

  /**
   * Gets the stylesheet paths associated with the widget.
   *
   * @return array An array of stylesheet paths
   */
  public function getStylesheets()
  {
    $stylesheets = parent::getStylesheets();
    $stylesheets['/sfFormExtraPlugin/css/jquery.autocompleter.css'] = 'all';
    return $stylesheets;
  }

  /**
   * Gets the JavaScript paths associated with the widget.
   *
   * @return array An array of JavaScript paths
   */
  public function getJavascripts()
  {
    $javascripts = parent::getJavascripts();
    $javascripts[] = '/sfFormExtraPlugin/js/jquery.autocompleter.js';
    return $javascripts;
  }
}
