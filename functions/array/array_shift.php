<?php
/**
*mixed array_shift ( array &array )
*array_shift() 将 array 的第一个单元移出并作为结果返回，将 array 的长度减一并将所有其它单元向前移动一位。
*所有的数字键名将改为从零开始计数，文字键名将不变。如果 array 为空（或者不是数组），则返回 NULL。 
*注意: 使用本函数后会重置（reset()）数组指针。
*/
$stack = array("orange", "banana", "apple", "raspberry");
$fruit = array_shift($stack);
var_dump($fruit);
var_dump($stack);
