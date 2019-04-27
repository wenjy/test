<?php

/**
*array array_count_values ( array input )
*array_count_values() 返回一个数组，该数组用 input 数组中的值作为键名，该值在 input 数组中出现的次数作为值。 
*/

$array = array(1, "hello", 1, "world", "hello");
var_dump(array_count_values ($array));
