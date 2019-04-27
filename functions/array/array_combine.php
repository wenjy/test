<?php
/**
*array array_combine ( array keys, array values )
*返回一个 array，用来自 keys 数组的值作为键名，来自 values 数组的值作为相应的值。 
*如果两个数组的单元数不同或者数组为空时返回 FALSE。 
*/
$a = array('green', 'red', 'yellow');
$b = array('avocado', 'apple', 'banana');
$c = array_combine($a, $b);

var_dump($c);