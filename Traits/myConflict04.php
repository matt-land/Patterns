<?php
/**
 * Created by PhpStorm.
 * User: mland
 * Date: 7/24/14
 * Time: 10:08 AM
 */

namespace Pattern\Samples;

trait A
{
    public function nop() { echo 'A'; }
}

abstract class myAbstract
{
    public function nop() { echo 'Abstract'; }
}
class myConflict extends myAbstract
{
    use A;

    /**
     * Trait overrides Parent!!!
     */
    
    public function __construct() { $this->nop(); }
}
new myConflict();