<?php namespace Pattern\Samples;
use Predis\Client;
trait tMySettings
{
    private $_redisClient = null;

    /**
     * do not want to override constructor
     */
    private function __init()
    {
        $this->_redisClient = new Client();
    }

    private function _getCaller()
    {
        $callers = debug_backtrace();
        return $callers[2]['function'];
    }

    /**
     * @param $method
     * @param $args
     *
     * @return $this
     * @throws \Exception
     *
     * now trapping with call
     */
    public function __call($method, $args)
    {
        switch (count($args)) {
            case 1:
                $this->saveSetting($method, $args[1]);
                return $this;
            case 0:
                $this->getSetting($method);
                return $this;
            default:
                throw new \Exception("unknown method not trapped in __Call");
        }
    }
    private function saveSetting($name = '', $value = '')
    {
        if ( ! strlen($name)) {
            throw new \Exception ('invalid setting name');
        }
        $this->__init();
        $this->_redisClient->set($this->_getCaller() . $name, $value);
    }

    private function getSetting($name)
    {
        if ( ! strlen($name)) {
            throw new \Exception ('invalid setting name');
        }
        $this->__init();
        return $this->_redisClient->get($this->_getCaller() . $name);
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
        //magic method, (setter)
        $user->lastLogin(date('U'));
        //magic method, (getters)
        mail($user->email(), 'Thanks for signing in!', 'Your account was used to sign in at '. date('H:i:s', $user->lastLogin()));

        if ($user->sessionTime() > $this->session_max_time()) {
            $user->sessionDestroy();
        }
    }
}

new myClass(
    new myUser()
);