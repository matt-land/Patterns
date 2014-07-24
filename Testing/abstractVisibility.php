<?php
abstract class parentClass
{
    protected $parentProperty1 = 'parent';

	public function parentProperties()
	{
		return get_object_vars($this);
	}
}

final class myClass extends parentClass
{
	private $classProperty1 = 'class';

    protected $classProperty2 = 'class';

	public function classProperties()
	{
		return get_object_vars($this);
	}
}
$c = new myClass();
echo "Abstract: ".count($c->parentProperties())."\n";
echo "Class: ".count($c->classProperties())."\n";

