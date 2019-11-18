<?php
/**
 * @author: 文江义
 * @date: 15:23 2019/9/23
 */

class TestAA
{
    protected $id = 0;

    public static $id_recorder = 1;

    public function __construct()
    {
        $this->id = self::$id_recorder++;
    }
}

$a1 = new TestAA();
$a1 = new TestAA();
$a1 = new TestAA();
$a1 = new TestAA();

var_dump(TestAA::$id_recorder);

