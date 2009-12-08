<?php

/**
 * ExcelFile form.
 *
 * @package    form
 * @subpackage ExcelFile
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ExcelFileForm extends BaseExcelFileForm
{
  public function configure()
  {
    $this->setWidget('file', new sfWidgetFormInputFile());
    $this->setValidator('file', new sfValidatorFile(array('path' => 'uploads/')));
  }
}