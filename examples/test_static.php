<?php
/**
 * @author: 文江义
 * @date: 9:39 2019/8/12
 */

class A1
{
    public function test()
    {
        static $events = [
            'a',
            'b',
        ];
        var_dump($events);
    }
}

class A2 extends A1
{

    public $aaaCCC = 123;
    public function test()
    {
        parent::test(); // TODO: Change the autogenerated stub
    }

    public function test2()
    {
        static $events = 'c';
        var_dump($events);
    }
}

$class = new A2();
$class->test2();
$class->tesT();
