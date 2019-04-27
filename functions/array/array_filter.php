<?php
/**
*array array_filter ( array input [, callback callback] )
*array_filter() 依次将 input 数组中的每个值传递到 callback 函数。如果 callback 函数返回 TRUE，则 input 数组的当前值会被包含在返回的结果数组中。
*数组的键名保留不变。
*/

function odd($var)
{
    return($var % 2 == 1);
}

function even($var)
{
    return($var % 2 == 0);
}

$array1 = array("a"=>1, "b"=>2, "c"=>3, "d"=>4, "e"=>5);
$array2 = array(6, 7, 8, 9, 10, 11, 12);

echo "Odd :\n";
var_dump(array_filter($array1, "odd"));
echo "Even:\n";
var_dump(array_filter($array2, "even"));

//用户不应在回调函数中修改数组本身。例如增加／删除单元或者对 array_filter() 正在作用的数组进行 unset。如果数组改变了，此函数的行为没有定义。 
//如果没有提供 callback 函数，array_filter() 将删除 input 中所有等值为 FALSE 的条目。
$entry = array(
             0 => 'foo',
             1 => false,
             2 => -1,
             3 => null,
             4 => ''
          );

var_dump(array_filter($entry));