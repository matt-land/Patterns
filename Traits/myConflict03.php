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

trait B
{
    public function nop() { echo 'B'; }
}

abstract class myAbstract
{
    public function nop() { echo 'Abstract'; }
}
class myConflict extends myAbstract
{
    use A,B;

    /**
     * This will also work just fine
     */
    public function nop() {
        A::nop();
        B::nop();
        parent::nop();
        echo 'Concrete';
    }

    public function __construct() { $this->nop(); }
}
new myConflict();