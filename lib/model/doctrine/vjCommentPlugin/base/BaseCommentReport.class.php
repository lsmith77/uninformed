<?php

/**
 * BaseCommentReport
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property clob $reason
 * @property string $referer
 * @property enum $state
 * @property integer $id_comment
 * @property Comment $Comment
 * 
 * @method clob          getReason()     Returns the current record's "reason" value
 * @method string        getReferer()    Returns the current record's "referer" value
 * @method enum          getState()      Returns the current record's "state" value
 * @method integer       getIdComment()  Returns the current record's "id_comment" value
 * @method Comment       getComment()    Returns the current record's "Comment" value
 * @method CommentReport setReason()     Sets the current record's "reason" value
 * @method CommentReport setReferer()    Sets the current record's "referer" value
 * @method CommentReport setState()      Sets the current record's "state" value
 * @method CommentReport setIdComment()  Sets the current record's "id_comment" value
 * @method CommentReport setComment()    Sets the current record's "Comment" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCommentReport extends MyBaseRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comment_report');
        $this->hasColumn('reason', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('referer', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('state', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'valid',
              1 => 'invalid',
              2 => 'untreated',
             ),
             'default' => 'untreated',
             ));
        $this->hasColumn('id_comment', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Comment', array(
             'local' => 'id_comment',
             'foreign' => 'id',
             'onDelete' => 'cascade'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}