<?php
/**
 * @author: 文江义
 * @date: 15:35 2019/6/3
 * 当尝试以调用函数的方式调用一个对象时，__invoke() 方法会被自动调用。
 */

class CallableClass
{
    function __invoke($x) {
        var_dump($x);
    }
}
$obj = new CallableClass;
$obj(5);
var_dump(is_callable($obj));
