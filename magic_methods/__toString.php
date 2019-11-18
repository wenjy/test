<?php
/**
 * @author: 文江义
 * @date: 15:34 2019/6/3
 */

class TestClass
{
    public $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }

    public function __toString() {
        return $this->foo;
    }
}

$class = new TestClass('Hello');
echo $class;
