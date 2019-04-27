<?php
/**
*array array_intersect_assoc ( array array1, array array2 [, array ...] )
*array_intersect_assoc() 返回一个数组，该数组包含了所有在 array1 中也同时出现在所有其它参数数组中的值。注意和 array_intersect() 不同的是键名也用于比较。
*/

$array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
$array2 = array("a" => "green", "yellow", "red");
$result_array = array_intersect_assoc($array1, $array2);

var_dump($result_array);

//上面例子中可以看到只有键值对 "a" => "green" 在两个数组中都存在从而被返回。
//值 "red" 没有被返回是因为在 $array1 中它的键名是 0 而在 $array2 中 "red" 的键名是 1。 
//键值对 key => value 中的两个值仅在 (string) $elem1 === (string) $elem2 时被认为相等。也就是说使用了严格检查，字符串的表达必须相同。 

