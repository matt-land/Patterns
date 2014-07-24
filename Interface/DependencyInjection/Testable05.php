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
    public function getAuthLevel(){ return $this->_array['authLevel']; }
    public function getUserName(){ return $this->_array['userName']; }
}
/**
 * Class AdminRestartController
 * @package Pattern\Samples
 */
class AdminRestartController
{
    public function __construct(iMySiteUser $user)
    {
        if ($user->getAuthLevel() < 'ZEUS') {
            throw new \Exception ('User is not allowed to perform actions.');
        }
        mail('ops@sparefoot.com', 'Restart Request by ' . $user->getUserName(), 'The system is going down now!');
        $this->_initRestart();
    }
    private function _initRestart() { shell_exec('shutdown -r now'); }
}
/**
 * so go look in the db,
 * ...find a user, or my account, stick the number in...
 * ...EVERY TIME, because the database might have changed
 */
new AdminRestartController(new MySiteUser(18302));
/**
 * or Decouple from the database and be Done!
 */
new AdminRestartController(
    new TestableMySiteUser()
);
/**
 * and statically define other variants without dependency
 */
new AdminRestartController(
    new TestableMySiteUser(
        array(
            'authLevel' => 'ZEUS',
            'userName'  => 'theHammer'
        )
    )
);