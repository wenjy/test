<?php
/**
*array array_intersect_key ( array array1, array array2 [, array ...] )
*array_intersect_key() 返回一个数组，该数组包含了所有出现在 array1 中并同时出现在所有其它参数数组中的键名的值。
*/

$array1 = array('blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4);
$array2 = array('green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8);

var_dump(array_intersect_key($array1, $array2));

//上例中可以看到只有 'blue' 和 'green' 两个键名出现在两个数组中，因此被返回。此外注意 'blue' 和 'green' 的值在两个数组中是不同的。
//但因为只检查键名，因此还是匹配。返回的值只是 array1 中的。 
//在 key => value 对中的两个键名仅在 (string) $key1 === (string) $key2 时被认为相等。换句话说，执行的是严格类型检查，因此字符串的表达必须完全一样。
