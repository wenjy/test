<?php
/**
*array array_change_key_case ( array input [, int case] )
*array_change_key_case() 将 input 数组中的所有键名改为全小写或大写。改变是根据后一个选项 case 参数来进行的。
*可以在这里用两个常量，CASE_UPPER 和 CASE_LOWER。默认值是 CASE_LOWER。本函数不改变数字索引。
*/

$arr = [
	'A' => 1,
	'B' => 2,
	'c' => 3,
	'd' => 4
	];

$arr = array_change_key_case($arr, CASE_LOWER);
var_dump($arr);

$arr = array_change_key_case($arr, CASE_UPPER);
var_dump($arr);