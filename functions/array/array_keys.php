<?php
/**
*array array_keys ( array input [, mixed search_value [, bool strict]] )
*array_keys() 返回 input 数组中的数字或者字符串的键名。 
*如果指定了可选参数 search_value，则只返回该值的键名。否则 input 数组中的所有键名都会被返回。自 PHP 5 起，可以用 strict 参数来进行全等比较（===）。 
*/

$array = array(0 => 100, "color" => "red");
var_dump(array_keys($array));

$array = array("blue", "red", "green", "blue", "blue");
var_dump(array_keys($array, "blue"));

$array = array("color" => array("blue", "red", "green"),
               "size"  => array("small", "medium", "large"));
var_dump(array_keys($array));
