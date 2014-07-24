<?php namespace Pattern\Samples;
interface iMySiteUser
{
    public function getAuthLevel();
    public function getUserName();
}
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
    public function getAuthLevel(){ return $this->_user->authLevel; }
    public function getUserName(){ return $this->_user->userName; }
}

/**
 * Class TestableMySiteUser
 * @package Pattern\Samples
 */
class TestableMySiteUser implements iMySiteUser
{
    private $_array = [
        'authLevel' => 'Hera',
        'userName' => 'IBiteBellyButtons'
    ];
    public function __construct(array $array = array())
    {
        foreach ($this->_array as $key => &$value) {
            $value = isset($array[$key]) ? $array[$key] : null;
        }
    }
    public function getAuthLevel()
    {
        return $this->_array['authLevel'];
    }

    public function getUserName()
    {
        return $this->_array['userName'];
    }
}