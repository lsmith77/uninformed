<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseTagHierarchieTag extends BaseRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tag_hierarchie_tag');
        $this->hasColumn('taghierarchie_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('tag_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));

        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
    $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}