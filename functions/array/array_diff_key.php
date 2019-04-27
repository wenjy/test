<?php
/**
*array array_diff_key ( array array1, array array2 [, array ...] )*
*array_diff_key() 返回一个数组，该数组包括了所有出现在 array1 中但是未出现在任何其它参数数组中的键名的值。
*注意关联关系保留不变。本函数和 array_diff() 相同只除了比较是根据键名而不是值来进行的。
*/

$array1 = array('blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4);
$array2 = array('green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8);

var_dump(array_diff_key($array1, $array2));
