<?php
/**
array array_values ( array input )
array_values() 返回 input 数组中所有的值并给其建立数字索引。
*/

$array = array("size" => "XL", "color" => "gold");
var_dump(array_values($array));