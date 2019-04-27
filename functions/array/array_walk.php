<?php
/**
bool array_walk ( array &array, callback funcname [, mixed userdata] )
如果成功则返回 TRUE，失败则返回 FALSE。 
将用户自定义函数 funcname 应用到 array 数组中的每个单元。典型情况下 funcname 接受两个参数。
array 参数的值作为第一个，键名作为第二个。如果提供了可选参数 userdata，将被作为第三个参数传递给 callback funcname。 
如果 funcname 函数需要的参数比给出的多，则每次 array_walk() 调用 funcname 时都会产生一个 E_WARNING 级的错误。
这些警告可以通过在 array_walk() 调用前加上 PHP 的错误操作符 @ 来抑制，或者用 error_reporting()。 
注意: 如果 funcname 需要直接作用于数组中的值，则给 funcname 的第一个参数指定为引用。这样任何对这些单元的改变也将会改变原始数组本身。 
注意: 将键名和 userdata 传递到 funcname 中是 PHP 4.0 新增加的。 
array_walk() 不会受到 array 内部数组指针的影响。array_walk() 会遍历整个数组而不管指针的位置。 
用户不应在回调函数中改变该数组本身。例如增加/删除单元，unset 单元等等。如果 array_walk() 作用的数组改变了，则此函数的的行为未经定义，且不可预期。
*/

$fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");

function test_alter(&$item1, $key, $prefix)
{
    $item1 = "$prefix: $item1";
}

function test_print($item2, $key)
{
    echo "$key. $item2<br />\n";
}

echo "Before ...:\n";
array_walk($fruits, 'test_print');

array_walk($fruits, 'test_alter', 'fruit');
echo "... and after:\n";

array_walk($fruits, 'test_print');