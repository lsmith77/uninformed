<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version3 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('organisation', 'description', 'clob', '', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('organisation', 'description');
    }
}