<?php
/**
*mixed array_rand ( array input [, int num_req] )
*array_rand() 在你想从数组中取出一个或多个随机的单元时相当有用。它接受 input 作为输入数组和一个可选的参数 num_req，
*指明了你想取出多少个单元 － 如果没有指定，默认为 1。 
*如果你只取出一个，array_rand() 返回一个随机单元的键名，否则就返回一个包含随机键名的数组。这样你就可以随机从数组中取出键名和值。 
*注意: 自 PHP 4.2.0 起，不再需要用 srand() 或 mt_srand() 函数给随机数发生器播种，现已自动完成。
*/
//srand((float) microtime() * 10000000);
$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
$rand_keys = array_rand($input, 2);
print $input[$rand_keys[0]] . "\n";
print $input[$rand_keys[1]] . "\n";
