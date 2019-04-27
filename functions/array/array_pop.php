<?php
/**
*mixed array_pop ( array &array )
*array_pop() 弹出并返回 array 数组的最后一个单元，并将数组 array 的长度减一。如果 array 为空（或者不是数组）将返回 NULL。 
*注意: 使用本函数后会重置（reset()）数组指针。
*/
$stack = array("orange", "banana", "apple", "raspberry");
$fruit = array_pop($stack);
var_dump($fruit);
var_dump($stack);
