<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version2 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('addressee', 'description', 'clob', '', array(
             ));
        $this->addColumn('clause_information_type', 'description', 'clob', '', array(
             ));
        $this->addColumn('clause_operative_phrase', 'description', 'clob', '', array(
             ));
        $this->addColumn('document_type', 'description', 'clob', '', array(
             ));
        $this->addColumn('tag', 'description', 'clob', '', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('addressee', 'description');
        $this->removeColumn('clause_information_type', 'description');
        $this->removeColumn('clause_operative_phrase', 'description');
        $this->removeColumn('document_type', 'description');
        $this->removeColumn('tag', 'description');
    }
}