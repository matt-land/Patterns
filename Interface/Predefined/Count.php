<?php namespace Pattern\Samples;
/**
 * Created by PhpStorm.
 * User: blitzcat
 * Date: 7/23/14
 * Time: 9:27 PM
 */
/**
 * Class myCountableClass
 * @package Pattern\Samples
 */
class myCountableClass implements \Countable
{
    private $_container = [
        'apple', [                  //1
            'eggs',                 //2
            'bacon', [              //3
                'honey waffles',    //4
                'pancakes',         //5
                'syrup'             //6
            ],
            'ham', [                //7
                'corn dogs',        //8
                'hot dogs',         //9
            ],
        ],
        'cherry',                   //10
        'dates',                    //11
        'entawak'                   //12
    ];
    private function _traverse($mixed) {
        $count = 0;
        foreach ($mixed as $value) {
            $count += is_array($value) ? $this->_traverse($value) : 1;
        }
        return $count;
    }
    /**
     * Countable required methods
     **/
    public function count()     { return $this->_traverse($this->_container); }
}

echo "There are ", count(new myCountableClass()), " items nested in the array.\n";