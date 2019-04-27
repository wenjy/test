<?php
/**
array array_udiff_uassoc ( array array1, array array2 [, array ..., callback data_compare_func, callback key_compare_func] )
array_udiff_uassoc() 返回一个数组，该数组包括了所有在 array1 中但是不在任何其它参数数组中的值。
注意和 array_diff() 与 array_udiff() 不同的是键名也用于比较。数组数据的比较是用用户提供的回调函数 data_compare_func 进行的。
在此方面和 array_diff_assoc() 的行为正好相反，后者是用内部函数进行比较的。对键名（索引）的检查也是由回调函数 key_compare_func 进行的。
这和 array_udiff_assoc() 的行为不同，后者是用内部函数比较索引的。 
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

    function comp_func_key($a, $b)
    {
        if ($a === $b) return 0;
        return ($a > $b)? 1:-1;
    }
}
$a = array("0.1" => new cr(9), "0.5" => new cr(12), 0 => new cr(23), 1=> new cr(4), 2 => new cr(-15),);
$b = array("0.2" => new cr(9), "0.5" => new cr(22), 0 => new cr(3), 1=> new cr(4), 2 => new cr(-15),);

$result = array_udiff_uassoc($a, $b, array("cr", "comp_func_cr"), array("cr", "comp_func_key"));
var_dump($result);
