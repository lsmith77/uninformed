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

    $this->validatorSchema['file'] = new sfValidatorFile(array(
      'mime_types' => array('application/excel', 'application/vnd.ms-excel', 'application/x-excel', 'application/x-msexcel', 'application/vnd.ms-office'),
      'path'       => sfConfig::get('sf_data_dir').'/files/excel',
    ));
  }
}
