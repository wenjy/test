<?php
/**
*array array_diff_assoc ( array array1, array array2 [, array ...] )
*array_diff_assoc() 返回一个数组，该数组包括了所有在 array1 中但是不在任何其它参数数组中的值。注意和 array_diff() 不同的是键名也用于比较。
*/

$array1 = array ("a" => "green", "b" => "brown", "c" => "blue", "red");
$array2 = array ("a" => "green", "yellow", "red");
$result = array_diff_assoc($array1, $array2);
var_dump($result);