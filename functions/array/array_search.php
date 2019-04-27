<?php
/**
*mixed array_search ( mixed needle, array haystack [, bool strict] )
*在 haystack 中搜索 needle 参数并在找到的情况下返回键名，否则返回 FALSE。 
*注意: 如果 needle 是字符串，则比较以区分大小写的方式进行。 
*注意: 在 PHP 4.2.0 之前，array_search() 在失败时返回 NULL 而不是 FALSE。 
*如果可选的第三个参数 strict 为 TRUE，则 array_search() 还将在 haystack 中检查 needle 的类型。 
*如果 needle 在 haystack 中出现不止一次，则返回第一个匹配的键。要返回所有匹配值的键，应该用 array_keys() 加上可选参数 search_value 来代替。 
*/
$array = array(0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red');

$key = array_search('green', $array); // $key = 2;
var_dump($key);
$key = array_search('red', $array);   // $key = 1;
var_dump($key);
//本函数可能返回布尔值 FALSE，但也可能返回一个与 FALSE 等值的非布尔值，例如 0 或者 ""。
