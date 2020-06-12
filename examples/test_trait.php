<?php
/**
 * @author: jiangyi
 * @date: 上午10:29 2018/8/23
 */

trait TraitA
{
    public $orderNo = 111;

    public function getOrderNo()
    {
        return $this->orderNo;
    }

    public function getExtraData()
    {
        return 222;
    }
}

trait TraitB
{
    public function getExtraData()
    {
        return 333;
    }
}

class TestB
{
    use TraitA;
}

class TestC
{
    use TraitB;
}

var_dump((new TestC())->getExtraData());return;

interface InterfaceA
{
    public function getOrderNo();
}

abstract class Test implements InterfaceA
{
}

class TestA extends Test
{
    use TraitA, TraitB {
        TraitB::getExtraData insteadof TraitA;
    }

}

echo (new TestA())->getOrderNo();
$obj = [];
for ($i = 0; $i < 10; $i++) {
    $obj[] = [
        'a' => 1,
        'b' => 2,
    ];
}
