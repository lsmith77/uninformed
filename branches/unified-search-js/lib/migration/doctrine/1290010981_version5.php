<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version5 extends Doctrine_Migration_Base
{
    public function up()
    {
        $connection = Doctrine_Manager::connection();
        $connection->execute('CREATE TEMPORARY TABLE document_is_latest
            SELECT COALESCE(root_document_id, id) AS root_id, MAX(adoption_date) AS max_adoption_date
            FROM document GROUP BY COALESCE(root_document_id, id)');

        $connection->execute('UPDATE document SET is_latest_document = 0
            WHERE ROW(COALESCE(root_document_id, id), adoption_date) NOT IN (SELECT * FROM document_is_latest)');

        $connection->execute('DROP TEMPORARY TABLE document_is_latest');

    }

    public function down()
    {
        $connection = Doctrine_Manager::connection();
        $connection->execute('UPDATE document SET is_latest_document = 1');
    }
}
