<?php namespace Pattern\Samples;
use Predis\Client;
trait tMySettings
{
    private $_client = null;

    /**
     * do not want to override constructor
     */
    private function __init()
    {
        $this->_client = new Client();
    }

    private function _getCaller()
    {
        $callers = debug_backtrace();
        return $callers[2]['function'];
    }

    public function saveSetting($name = '', $value = '')
    {
        if ( ! strlen($name)) {
            throw new \Exception ('invalid setting name');
        }
        $this->__init();
        $this->_client->set($this->_getCaller() . $name, $value);
    }

    public function getSetting($name)
    {
        if ( ! strlen($name)) {
            throw new \Exception ('invalid setting name');
        }
        $this->__init();
        return $this->_client->get($this->_getCaller() . $name);
    }
}
class myUser
{
    const SESSION_TIME_SETTING = 'session_max_time';
    public function sessionTime() { return rand(22,12345); }
    public function sessionDestroy() { session_destroy(); }
}
class myClass
{
    use tMySettings;

    public function __construct(MyUser $user)
    {
        if ($user->sessionTime() > $this->getSetting(myUser::SESSION_TIME_SETTING)) {
            $user->sessionDestroy();
        }
    }
}

new myClass(
    new myUser()
);