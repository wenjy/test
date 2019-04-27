<?php
/**
array array_uintersect ( array array1, array array2 [, array ..., callback data_compare_func] )
array_uintersect() 返回一个数组，该数组包含了所有在 array1 中也同时出现在所有其它参数数组中的值。数据比较是用回调函数进行的。 
*/

$array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
$array2 = array("a" => "GREEN", "B" => "brown", "yellow", "red");

var_dump(array_uintersect($array1, $array2, "strcasecmp"));
