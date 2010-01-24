<?php

/**
 * BasesfGuardUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $username
 * @property string $algorithm
 * @property string $salt
 * @property string $password
 * @property boolean $is_active
 * @property boolean $is_super_admin
 * @property timestamp $last_login
 * @property string $email_address
 * @property string $type
 * @property integer $excel_file_id
 * @property Doctrine_Collection $groups
 * @property Doctrine_Collection $permissions
 * @property Doctrine_Collection $sfGuardUserPermission
 * @property Doctrine_Collection $sfGuardUserGroup
 * @property sfGuardRememberKey $RememberKeys
 * @property Doctrine_Collection $ExcelFile
 * 
 * @method integer             getId()                    Returns the current record's "id" value
 * @method string              getUsername()              Returns the current record's "username" value
 * @method string              getAlgorithm()             Returns the current record's "algorithm" value
 * @method string              getSalt()                  Returns the current record's "salt" value
 * @method string              getPassword()              Returns the current record's "password" value
 * @method boolean             getIsActive()              Returns the current record's "is_active" value
 * @method boolean             getIsSuperAdmin()          Returns the current record's "is_super_admin" value
 * @method timestamp           getLastLogin()             Returns the current record's "last_login" value
 * @method string              getEmailAddress()          Returns the current record's "email_address" value
 * @method string              getType()                  Returns the current record's "type" value
 * @method integer             getExcelFileId()           Returns the current record's "excel_file_id" value
 * @method Doctrine_Collection getGroups()                Returns the current record's "groups" collection
 * @method Doctrine_Collection getPermissions()           Returns the current record's "permissions" collection
 * @method Doctrine_Collection getSfGuardUserPermission() Returns the current record's "sfGuardUserPermission" collection
 * @method Doctrine_Collection getSfGuardUserGroup()      Returns the current record's "sfGuardUserGroup" collection
 * @method sfGuardRememberKey  getRememberKeys()          Returns the current record's "RememberKeys" value
 * @method Doctrine_Collection getExcelFile()             Returns the current record's "ExcelFile" collection
 * @method sfGuardUser         setId()                    Sets the current record's "id" value
 * @method sfGuardUser         setUsername()              Sets the current record's "username" value
 * @method sfGuardUser         setAlgorithm()             Sets the current record's "algorithm" value
 * @method sfGuardUser         setSalt()                  Sets the current record's "salt" value
 * @method sfGuardUser         setPassword()              Sets the current record's "password" value
 * @method sfGuardUser         setIsActive()              Sets the current record's "is_active" value
 * @method sfGuardUser         setIsSuperAdmin()          Sets the current record's "is_super_admin" value
 * @method sfGuardUser         setLastLogin()             Sets the current record's "last_login" value
 * @method sfGuardUser         setEmailAddress()          Sets the current record's "email_address" value
 * @method sfGuardUser         setType()                  Sets the current record's "type" value
 * @method sfGuardUser         setExcelFileId()           Sets the current record's "excel_file_id" value
 * @method sfGuardUser         setGroups()                Sets the current record's "groups" collection
 * @method sfGuardUser         setPermissions()           Sets the current record's "permissions" collection
 * @method sfGuardUser         setSfGuardUserPermission() Sets the current record's "sfGuardUserPermission" collection
 * @method sfGuardUser         setSfGuardUserGroup()      Sets the current record's "sfGuardUserGroup" collection
 * @method sfGuardUser         setRememberKeys()          Sets the current record's "RememberKeys" value
 * @method sfGuardUser         setExcelFile()             Sets the current record's "ExcelFile" collection
 * 
 * @package    uninformed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BasesfGuardUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_user');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('username', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => '128',
             ));
        $this->hasColumn('algorithm', 'string', 128, array(
             'type' => 'string',
             'default' => 'sha1',
             'notnull' => true,
             'length' => '128',
             ));
        $this->hasColumn('salt', 'string', 128, array(
             'type' => 'string',
             'length' => '128',
             ));
        $this->hasColumn('password', 'string', 128, array(
             'type' => 'string',
             'length' => '128',
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
        $this->hasColumn('is_super_admin', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('last_login', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('email_address', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => '128',
             ));
        $this->hasColumn('type', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('excel_file_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => '4',
             ));


        $this->index('is_active_idx', array(
             'fields' => 
             array(
              0 => 'is_active',
             ),
             ));
        $this->option('collation', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');

        $this->setSubClasses(array(
             'Import' => 
             array(
              'type' => 'Import',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('sfGuardGroup as groups', array(
             'refClass' => 'sfGuardUserGroup',
             'local' => 'user_id',
             'foreign' => 'group_id'));

        $this->hasMany('sfGuardPermission as permissions', array(
             'refClass' => 'sfGuardUserPermission',
             'local' => 'user_id',
             'foreign' => 'permission_id'));

        $this->hasMany('sfGuardUserPermission', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('sfGuardUserGroup', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasOne('sfGuardRememberKey as RememberKeys', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('ExcelFile', array(
             'local' => 'id',
             'foreign' => 'author_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $blameable0 = new Doctrine_Template_Blameable(array(
             'default' => NULL,
             'blameVar' => 'id',
             'listener' => 'BlameableCustomListener',
             'columns' => 
             array(
              'created' => 
              array(
              'name' => 'author_id',
              'length' => 4,
              'options' => 
              array(
               'notnull' => false,
              ),
              ),
              'updated' => 
              array(
              'disabled' => true,
              ),
             ),
             'relations' => 
             array(
              'created' => 
              array(
              'class' => 'sfGuardUser',
              'disabled' => false,
              'name' => 'Author',
              ),
             ),
             ));
        $this->actAs($timestampable0);
        $this->actAs($softdelete0);
        $this->actAs($blameable0);
    }
}