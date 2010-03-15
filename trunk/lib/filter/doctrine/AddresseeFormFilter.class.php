<?php

/**
 * Addressee filter form.
 *
 * @package    uninformed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AddresseeFormFilter extends BaseAddresseeFormFilter
{
  public function configure()
  {
  	parent::configure();
  	
  	sfContext::switchTo('backend');
  	
  	//$this->widgetSchema['clauses_list']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    /*$this->widgetSchema['clauses_list']->setOption('renderer_options', array(
      'model' => 'ClauseBody',
      //'id' => 'findOneByOrganisationId',
      'url'   => sfContext::getInstance()->getController()->genUrl('addressee/clauseBodyAutocomplete'),
    ));*/
  	
  	$this->widgetSchema['clause'] = new sfWidgetFormDoctrineJQueryAutocompleter(
      array(
        'model' => 'Clause',
        //'id' => 'findOneById',
        'url'   => sfContext::getInstance()->getController()->genUrl('clause/autocomplete'),
      )
  	);
  }
  
  public function getFields()
  {
    $fields = parent::getFields();
    $fields['clause'] = 'clause';
    
    return $fields;
  }
  
	public function addClauseColumnQuery($query, $field, $value)
	{
	  Doctrine::getTable('Addressee')
	    ->applyClauseFilter($query, $value);
	}
}
