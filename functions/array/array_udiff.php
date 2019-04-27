<?php
/**
array array_udiff ( array array1, array array2 [, array ..., callback data_compare_func] )
array_udiff() 返回一个数组，该数组包括了所有在 array1 中但是不在任何其它参数数组中的值。注意键名保持不变。
数据的比较是用 data_compare_func 进行的。如果认为第一个参数小于，等于，或大于第二个参数时必须分别返回一个小于零，等于零，或大于零的整数。
这和 array_diff() 不同，后者使用了内部函数来比较数据。 
*/

class cr {
    private $priv_member;
    function cr($val)
    {
        $this->priv_member = $val;
    }

    function comp_func_cr($a, $b)
    {
        if ($a->priv_member === $b->priv_member) return 0;
        return ($a->priv_member > $b->priv_member)? 1:-1;
    }
}
$a = array("0.1" => new cr(9), "0.5" => new cr(12), 0 => new cr(23), 1=> new cr(4), 2 => new cr(-15),);
$b = array("0.2" => new cr(9), "0.5" => new cr(22), 0 => new cr(3), 1=> new cr(4), 2 => new cr(-15),);

$result = array_udiff($a, $b, array("cr", "comp_func_cr"));
var_dump($result);
