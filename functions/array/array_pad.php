<?php
/**
*array array_pad ( array input, int pad_size, mixed pad_value )
*array_pad() 返回 input 的一个拷贝，并用 pad_value 将其填补到 pad_size 指定的长度。
*如果 pad_size 为正，则数组被填补到右侧，如果为负则从左侧开始填补。如果 pad_size 的绝对值小于或等于 input 数组的长度则没有任何填补。
*有可能一次最多填补 1048576 个单元。
*/
$input = array(12, 10, 9);

$result = array_pad($input, 5, 0);
// result is array(12, 10, 9, 0, 0)
var_dump($result);

$result = array_pad($input, -7, -1);
// result is array(-1, -1, -1, -1, 12, 10, 9)
var_dump($result);

$result = array_pad($input, 2, "noop");
// not padded
var_dump($result);