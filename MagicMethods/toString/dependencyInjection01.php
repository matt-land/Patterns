<?php
/**
 * Created by PhpStorm.
 * User: mland
 * Date: 7/24/14
 * Time: 10:40 AM
 */

/**
 * dependency injection: functions ‘consume’ the (cast) objects instead of parameter lists
 */

/*
 * bad: the parameter list is getting log.
 * Every param added makes testing even harder
 */

function doSomeLogic($aThis = '', $andThat = array(), $other)
{
    return $aThis * $andThat + $other;
}

/**
 * better: now we can pass params in any order
 */
function doSomeMoreLogic($array = array())
{
    $aThis = ( ! array_key_exists('this', $array)) ? $array['this'] : '';
    $andThat = ( ! array_key_exists('that', $array)) ? $array['that'] : array();
    $other = ( ! array_key_exists('other', $array)) ? $array['other'] : false;

    return $aThis * $andThat + $other;
}

/**
 * @param Object $object
 * best: pass in a object that we consume
 */
class myObject extends stdClass
{
    public $aThis = 'dfsd';
    public $andThat = array('dreams', 'eggshells');
    public $other = true;
}
function doLessLogic(myObject $myObject)
{
    return $myObject->aThis * $myObject->andThat + $myObject->other;
}
