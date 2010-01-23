<?php

/**
 * ExcelFile form.
 *
 * @package    uninformed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ExcelFileForm extends BaseExcelFileForm
{
  public function configure()
  {
    $this->setWidget(
      'file', new sfWidgetFormInputFile()
    );

    $this->setValidator(
      'file', new sfValidatorFile()
    );
  }
}
