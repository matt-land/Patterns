<?php
/**
 * Created by PhpStorm.
 * User: mland
 * Date: 5/2/14
 * Time: 9:13 PM
 */

interface fizzBuzzable
{
    function fizzBuzz();
}

/**
 * Class cupcake
 */
class cupcake implements fizzBuzzable
{
    function fizzBuzz()
    {
        $string = '';
        for ($i = 1; $i <= 100; $i++) {
            if ($i % 15 == 0)
                $string .= 'FizzBuzz';
            elseif ($i % 3 == 0)
                $string .= 'Fizz';
            elseif ($i % 5 == 0)
                $string .= 'Buzz';
            else
                $string.= $i;
            $string .= "\n";
        }
        return $string;
    }
}

/**
 * Class popTart
 * testing some coding concepts from "Clean Code: A Handbook of Agile Software Craftsmanship"
 */
class popTart implements fizzBuzzable
{
    const FIZZ = 'Fizz';
    const BUZZ = 'Buzz';
    const NEWLINE = "\n";

    private $_counter = 1;
    private $_output = '';

    public function fizzBuzz()
    {
        while ( ! $this->_testIfFinished()) {
            $this->_fizzBuzzNumber();
            $this->_incrementNumber();
        }
        return (String) $this;
    }

    private function _fizzBuzzNumber()
    {
        if ($this->_testFizz()) {
            $this->_addFizzToOutput();
        }
        if ($this->_testBuzz()) {
            $this->_addBuzzToOutput();
        }
        if ( ! $this->_testFizz() && ! $this->_testBuzz()) {
            $this->_addNumberToOutput();
        }
        $this->_addNewLineToOutput();
    }

    private function _incrementNumber()
    {
        $this->_counter ++;
    }

    private function _testIfFinished()
    {
        if ($this->_counter > 100) {
            return true;
        }
        return false;
    }

    private function _testFizz()
    {
        return ($this->_counter % 3)?false:true;
    }

    private function _testBuzz()
    {
        return ($this->_counter % 5)?false:true;
    }

    private function _addFizzToOutput()
    {
        $this->_output .= self::FIZZ;
    }

    private function _addBuzzToOutput()
    {
        $this->_output .= self::BUZZ;
    }

    private function _addNumberToOutput()
    {
        $this->_output .= $this->_counter;
    }

    private function _addNewlineToOutput()
    {
        $this->_output .= self::NEWLINE;
    }

    public function __toString()
    {
        return $this->_output;
    }
}

class fizzBuzzRunner
{
    static function inspectAndRun(fizzBuzzable $fb)
    {
        $class = get_class($fb);
        echo "Testing a {$class}\n";
        echo $fb->fizzBuzz();
        echo "\n";
    }
}

fizzBuzzRunner::inspectAndRun(new cupcake());
fizzBuzzRunner::inspectAndRun(new popTart());