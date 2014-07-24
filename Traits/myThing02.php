<?php namespace Pattern\Samples;
trait tMyLogger
{
    /**
     * @var bool
     * now we are much fancier than echo statements
     */
    private $_loggingEnabled = true;
    public function log($message)
    {
        if ( ! $this->_loggingEnabled) {
            return;
        }
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $caller   = $caller[1];
        $time = microtime(true);
        $micro = sprintf("%06d",($time - floor($time)) * 1000000);
        $date = new \DateTime( date('Y-m-d H:i:s.'.$micro, $time) );
        $string = $date->format("Y-m-d H:i:s.u") . " {$message}\n"
            ."\tin {$caller['class']}{$caller['type']}{$caller['function']}\n"
            ."\tline {$caller['line']} of {$caller['file']}\n" ;
        echo $string;
    }
}

class myThing
{
    use tMyLogger; //this adds all the methods of the trait

    public function __construct()
    {
        $this->log("unit constructed");
        $this->doStuff();
    }

    public function doStuff()
    {
        $this->log("now I'm doing stuff");
    }
}

new myThing();
