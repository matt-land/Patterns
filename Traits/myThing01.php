<?php namespace Pattern\Samples;
trait tMyLogger
{
    /**
     * @var bool
     * Can turn on/off all the echo messages in one swoop.
     * No more left in the code
     */
    private $_loggingEnabled = true;
    public function log($message)
    {
        if ( ! $this->_loggingEnabled) {
            return;
        }
        echo $message ."\n";
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
