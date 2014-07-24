<?php namespace Pattern\Samples;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use DateTime;
require_once '../vendor/autoload.php';
trait tMyLogger
{
    use LoggerTrait;
    public function log($level, $message, array $context = array())
    {
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $line   = $caller[1];
        $caller = $caller[2];
        $time = microtime(true);
        $micro = sprintf("%06d",($time - floor($time)) * 1000000);
        $date = new DateTime( date('Y-m-d H:i:s.'.$micro, $time) );
        $string = $date->format("Y-m-d H:i:s.u") . " [{$level}]: {$message}\n"
            ."\tin {$caller['class']}{$caller['type']}{$caller['function']}\n"
            ."\tline {$line['line']} of {$caller['file']}\n" ;
        echo $string;
    }
}

/**
 * Class myThing
 * @package Pattern\Samples
 * all the interface levels demoed
 */
class myThing implements LoggerInterface
{
    use tMyLogger;

    public function __construct()
    {
        $this->debug("unit constructed");
        $this->_stepOne();  $this->_pause();
        $this->_stepTwo();  $this->_pause();
        $this->_stepThree();$this->_pause();
        $this->_stepFour(); $this->_pause();
        $this->_stepFive(); $this->_pause();
        $this->_stepSix();  $this->_pause();
    }

    private function _stepOne() {   $this->info('at '. __FUNCTION__);}
    private function _stepTwo() {   $this->notice('at '. __FUNCTION__);}
    private function _stepThree() { $this->warning('at '. __FUNCTION__);}
    private function _stepFour() {  $this->error('at '. __FUNCTION__);}
    private function _stepFive() {  $this->critical('at '. __FUNCTION__);}
    private function _stepSix() {   $this->alert('at '. __FUNCTION__);}
    private function _pause() {     usleep (750000);   }


    /**
     * magic method destruct.
     */
    public function __destruct()
    {
        $this->emergency("unit destructed");
    }
}

$my = new myThing();

unset($my);