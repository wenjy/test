<?php
/**
*array array_intersect ( array array1, array array2 [, array ...] )
*array_intersect() 返回一个数组，该数组包含了所有在 array1 中也同时出现在所有其它参数数组中的值。注意键名保留不变。 
*/

$array1 = array("a" => "green", "red", "blue");
$array2 = array("b" => "green", "yellow", "red");
$result = array_intersect($array1, $array2);

var_dump($result);

//注意: 两个单元仅在 (string) $elem1 === (string) $elem2 时被认为是相同的。也就是说，当字符串的表达是一样的时候。 
