<?php
/**
array array_udiff_assoc ( array array1, array array2 [, array ..., callback data_compare_func] )
array_udiff_assoc() 返回一个数组，该数组包括了所有在 array1 中但是不在任何其它参数数组中的值。
注意和 array_diff() 与 array_udiff() 不同的是键名也用于比较。数组数据的比较是用用户提供的回调函数进行的。
在此方面和 array_diff_assoc() 的行为正好相反，后者是用内部函数进行比较的。
*/
class cr {
    private $priv_member;
    function __construct($val)
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

$result = array_udiff_assoc($a, $b, array("cr", "comp_func_cr"));
var_dump($result);

//上例中可以看到键值对 "1" => new cr(4) 同时出现在两个数组中因此不在本函数的输出中。 

//此比较是通过用户提供的回调函数来进行的。如果认为第一个参数小于，等于，或大于第二个参数时必须分别返回一个小于零，等于零，或大于零的整数。 

//注意: 注意本函数只检查了多维数组中的一维。当然，可以用 array_udiff_assoc($array1[0], $array2[0], "some_comparison_func"); 来检查更深的维度。