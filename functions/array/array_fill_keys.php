<?php
/**
*array array_fill_keys ( array keys, mixed value )
*array_fill_keys() 返回以keys作键，value作值的新数组。 
*/

$keys = array('foo', 5, 10, 'bar');
$a = array_fill_keys($keys, 'banana');
var_dump($a);