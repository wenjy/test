<?php
/**
*mixed array_reduce ( array input, callback function [, int initial] )
*array_reduce() 将回调函数 function 迭代地作用到 input 数组中的每一个单元中，从而将数组简化为单一的值。
*如果指定了可选参数 initial，该参数将被当成是数组中的第一个值来处理，或者如果数组为空的话就作为最终返回值。
*如果数组为空并且没有传递 initial 参数，array_reduce() 返回 NULL。
*/

function rsum($v, $w)
{
    $v += $w;
    return $v;
}

function rmul($v, $w)
{
    $v *= $w;
    return $v;
}

$a = array(1, 2, 3, 4, 5);
$x = array();
$b = array_reduce($a, "rsum");
$c = array_reduce($a, "rmul", 10);
$d = array_reduce($x, "rsum", 1);
var_dump($b);
var_dump($c);
var_dump($d);