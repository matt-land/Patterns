<?php namespace Pattern\Samples;
/**
 * Created by PhpStorm.
 * User: blitzcat
 * Date: 7/23/14
 * Time: 8:43 PM
 */
/**
 * Class myIteratorClass
 * @package Pattern\Samples
 */
class myIteratorClass implements \Iterator
{
    private $_container = ['apple', 'banana', 'cherry', 'dates', 'entawak'];
    private $_pointer = 0;
    /**
     * Iterator required methods
     **/
    public function current()   { return $this->_container[$this->_pointer]; }
    public function key()       { return $this->_pointer; }
    public function next()      { ++$this->_pointer; }
    public function rewind()    { $this->_pointer = 0; }
    public function valid()     { return array_key_exists($this->_pointer, $this->_container); }
}

foreach (new myIteratorClass() as $index => $fruit) {
    echo "Position ", $index, " is a ", $fruit, "\n";
}




