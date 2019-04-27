<?php
/**
*array array_fill ( int start_index, int num, mixed value )
*array_fill() 用 value 参数的值将一个数组填充 num 个条目，键名由 start_index 参数指定的开始。注意 num 必须是一个大于零的数值，否则 PHP 会发出一条警告。
*/

$a = array_fill(5, 6, 'banana');
var_dump($a);