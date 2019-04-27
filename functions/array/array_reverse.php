<?php
/**
*array array_reverse ( array array [, bool preserve_keys] )
*array_reverse() 接受数组 array 作为输入并返回一个单元为相反顺序的新数组，如果 preserve_keys 为 TRUE 则保留原来的键名。 
*/
$input  = array("php", 4.0, array("green", "red"));
$result = array_reverse($input);
var_dump($result);
$result_keyed = array_reverse($input, TRUE);
var_dump($result_keyed);
