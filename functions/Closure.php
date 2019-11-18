<?php
/**
 * @author: 文江义
 * @date: 10:22 2019/7/1
 */

class TestClosure
{
    protected $val;

    public function __construct($val)
    {
        $this->val = $val;
    }

    public function getClosure()
    {
        //returns closure bound to this object and scope
        return function () {
            return $this->val;
        };
    }

    public function getVal()
    {
        return $this->val;
    }
}

$ob1 = new TestClosure(1);
$ob2 = new TestClosure(2);

$cl = $ob1->getClosure();
echo $cl(), "\n";
$cl = $cl->bindTo($ob2);
echo $cl(), "\n";

$fuc = function () {
    return $this->getVal() + 1;
};

$cl = $fuc->bindTo($ob1);
echo $cl() . PHP_EOL;

$cl = Closure::bind($fuc, $ob2);
echo $cl() . PHP_EOL;
