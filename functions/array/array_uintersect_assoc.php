<?php
/**
array array_uintersect_assoc ( array array1, array array2 [, array ..., callback data_compare_func] )
array_uintersect_assoc() 返回一个数组，该数组包含了所有在 array1 中也同时出现在所有其它参数数组中的值。
注意和 array_uintersect() 不同的是键名也要比较。数据是用回调函数比较的。 
*/

$array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
$array2 = array("a" => "GREEN", "B" => "brown", "yellow", "red");

var_dump(array_uintersect_assoc($array1, $array2, "strcasecmp"));