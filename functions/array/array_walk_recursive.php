<?php
/**
bool array_walk_recursive ( array &input, callback funcname [, mixed userdata] )
将用户自定义函数 funcname 应用到 array 数组中的每个单元。本函数会递归到更深层的数组中去。
典型情况下 funcname 接受两个参数。input 参数的值作为第一个，键名作为第二个。
如果提供了可选参数 userdata，将被作为第三个参数传递给 callback funcname。 
如果成功则返回 TRUE，失败则返回 FALSE。 
注意: 如果 funcname 需要直接作用于数组中的值，则给 funcname 的第一个参数指定为引用。这样任何对这些单元的改变也将会改变原始数组本身。 
*/
$sweet = array('a' => 'apple', 'b' => 'banana');
$fruits = array('sweet' => $sweet, 'sour' => 'lemon');

function test_print($item, $key)
{
    echo "$key holds $item\n";
}

array_walk_recursive($fruits, 'test_print');
//注意上例中的键 'sweet' 并没有显示出来。任何其值为数组的键都不会被传递到回调函数中去。
