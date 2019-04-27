<?php
/**
bool krsort ( array &array [, int sort_flags] )
对数组按照键名逆向排序，保留键名到数据的关联。主要用于结合数组。 
如果成功则返回 TRUE，失败则返回 FALSE。
*/

$fruits = array("d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple");
krsort($fruits);
foreach ($fruits as $key => $val) {
    echo "$key = $val\n";
}

/**
bool ksort ( array &array [, int sort_flags] )
对数组按照键名排序，保留键名到数据的关联。本函数主要用于关联数组。 
如果成功则返回 TRUE，失败则返回 FALSE。 
*/
$fruits = array("d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple");
ksort($fruits);
foreach ($fruits as $key => $val) {
    echo "$key = $val\n";
}

