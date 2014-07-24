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

class myConflict
{
    use A,B;

    /**
     * This will work just fine
     */
    public function nop() { echo 'Concrete'; }

    public function __construct() { $this->nop(); }
}
new myConflict();