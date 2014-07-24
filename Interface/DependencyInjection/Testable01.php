<?php namespace Pattern\Samples;
/**
 * Interface iMySiteUser
 * @package Pattern\Samples
 */
interface iMySiteUser
{
    public function getAuthLevel();
    public function getUserName();
}

/**
 * Class UserRows
 * @package Pattern\Samples
 */
class UserRows extends Zend_Db_Table_Abstract { protected $_name = 'usersTable'; }

/**
 * Class MySiteUser
 * @package Pattern\Samples
 * just to implement iMySiteUser
 */
class MySiteUser implements iMySiteUser
{
    private $_user;
    public function __construct($userId = 0)
    {
        $userRows = new UserRows();
        $this->_user = $userRows->fetchRow($userRows->select()->where('user_id = ?', $userId));
    }

    public function getAuthLevel()
    {
        return $this->_user->authLevel;
    }

    public function getUserName()
    {
        return $this->_user->userName;
    }

    public function myOtherMethods() {} // ... not restricted by the interface
}