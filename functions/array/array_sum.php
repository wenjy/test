<?php
/**
number array_sum ( array array )
array_sum() 将数组中的所有值的和以整数或浮点数的结果返回。
*/

$a = array(2, 4, 6, 8);
echo "sum(a) = " . array_sum($a) . "\n";

$b = array("a" => 1.2, "b" => 2.3, "c" => 3.4);
echo "sum(b) = " . array_sum($b) . "\n";
