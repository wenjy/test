<?php
/**
bool in_array ( mixed needle, array haystack [, bool strict] )
在 haystack 中搜索 needle，如果找到则返回 TRUE，否则返回 FALSE。 
如果第三个参数 strict 的值为 TRUE 则 in_array() 函数还会检查 needle 的类型是否和 haystack 中的相同。 
注意: 如果 needle 是字符串，则比较是区分大小写的。 
注意: 在 PHP 版本 4.2.0 之前，needle 不允许是一个数组。 
*/
$os = array("Mac", "NT", "Irix", "Linux");
if (in_array("Irix", $os)) {
    echo "Got Irix";
}
if (in_array("mac", $os)) {
    echo "Got mac";
}

$a = array('1.10', 12.4, 1.13);

if (in_array('12.4', $a, true)) {
    echo "'12.4' found with strict check\n";
}
if (in_array(1.13, $a, true)) {
    echo "1.13 found with strict check\n";
}

$a = array(array('p', 'h'), array('p', 'r'), 'o');

if (in_array(array('p', 'h'), $a)) {
    echo "'ph' was found\n";
}
if (in_array(array('f', 'i'), $a)) {
    echo "'fi' was found\n";
}
if (in_array('o', $a)) {
    echo "'o' was found\n";
}
