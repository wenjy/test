<?php
/**
*int array_push ( array &array, mixed var [, mixed ...] )
*array_push() 将 array 当成一个栈，并将传入的变量压入 array 的末尾。array 的长度将根据入栈变量的数目增加。和如下效果相同： 
*/

$stack = array("orange", "banana");
array_push($stack, "apple", "raspberry");
var_dump($stack);

//注意: 如果用 array_push() 来给数组增加一个单元，还不如用 $array[] = ，因为这样没有调用函数的额外负担。 

//注意: 如果第一个参数不是数组，array_push() 将发出一条警告。这和 $var[] 的行为不同，后者会新建一个数组。 


