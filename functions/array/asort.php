<?php
/**
bool asort ( array &array [, int sort_flags] )
本函数对数组进行排序，数组的索引保持和单元的关联。主要用于对那些单元顺序很重要的结合数组进行排序。 
如果成功则返回 TRUE，失败则返回 FALSE。
*/
$fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");
asort($fruits);
foreach ($fruits as $key => $val) {
    echo "$key = $val\n";
}
//fruits 被按照字母顺序排序，并且单元的索引关系不变。 

//可以用可选的参数 sort_flags 改变排序的行为，详情见 sort()。 
