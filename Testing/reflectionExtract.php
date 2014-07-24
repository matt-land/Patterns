<?php

    class MyClass {
       public function __construct() { $this->priv = 42; }
       private $priv;
    }

    $a = new MyClass();

    $ref = new ReflectionClass("MyClass");

    $prop = $ref->getProperty("priv");
    $prop->setAccessible(TRUE);

    echo "priv: " . $prop->getValue($a) . "\n";  // OK!
