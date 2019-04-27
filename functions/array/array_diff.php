<?php
/**
*array array_diff ( array array1, array array2 [, array ...] )
*array_diff() 返回一个数组，该数组包括了所有在 array1 中但是不在任何其它参数数组中的值。注意键名保留不变。 
*/

$array1 = array("a" => "green", "red", "blue", "red");
$array2 = array("b" => "green", "yellow", "red");
$result = array_diff($array1, $array2);

var_dump($result);
