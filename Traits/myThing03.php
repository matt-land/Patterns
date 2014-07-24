<?php namespace Pattern\Samples;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use DateTime;
require_once '../vendor/autoload.php';
trait tMyLogger
{
    /**
     * Traits can use traits
     *
     * Using the PSR-3 logging trait implementation
     */
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
 * Now using the PSR-3 Logging interface
 */
class myThing implements LoggerInterface
{
    use tMyLogger; //this adds all the methods of the trait(s)

    public function __construct()
    {
        $this->info("unit constructed"); //refactored to use the new interface
        $this->doStuff();
    }

    public function doStuff()
    {
        $this->info("now I'm doing stuff"); //refactored to use the new interface
    }
}

new myThing();
