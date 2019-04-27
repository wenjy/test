<?php
/**
int array_unshift ( array &array, mixed var [, mixed ...] )
array_unshift() 将传入的单元插入到 array 数组的开头。注意单元是作为整体被插入的，因此传入单元将保持同样的顺序。
所有的数值键名将修改为从零开始重新计数，所有的文字键名保持不变。 
返回 array 数组新的单元数目。
*/

$queue = array("orange", "banana");
$res = array_unshift($queue, "apple", "raspberry");

var_dump($queue);
var_dump($res);
