<?php
/**
*array array_merge ( array array1 [, array array2 [, array ...]] )
*array_merge() 将一个或多个数组的单元合并起来，一个数组中的值附加在前一个数组的后面。返回作为结果的数组。 
*如果输入的数组中有相同的字符串键名，则该键名后面的值将覆盖前一个值。然而，如果数组包含数字键名，后面的值将不会覆盖原来的值，而是附加到后面。 
*如果只给了一个数组并且该数组是数字索引的，则键名会以连续方式重新索引。
*/

$array1 = array("color" => "red", 2, 4);
$array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
$result = array_merge($array1, $array2);
var_dump($result);

//别忘了数字键名将会被重新编号！ 
$array1 = array();
$array2 = array(1 => "data");
$result = array_merge($array1, $array2);
var_dump($result);

//如果你想完全保留原有数组并只想新的数组附加到后面，用 + 运算符：
$array1 = array();
$array2 = array(1 => "data");
$result = $array1 + $array2;
var_dump($result);

//array_merge() 的行为在 PHP 5 中被修改了。和 PHP 4 不同，array_merge() 现在只接受 array 类型的参数。不过可以用强制转换来合并其它类型。请看下面的例子。
$beginning = 'foo';
$end = array(1 => 'bar');
$result = array_merge((array)$beginning, (array)$end);
var_dump($result);
