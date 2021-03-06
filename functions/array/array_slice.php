<?php
/**
*array array_slice ( array array, int offset [, int length [, bool preserve_keys]] )
*array_slice() 返回根据 offset 和 length 参数所指定的 array 数组中的一段序列。 
*如果 offset 非负，则序列将从 array 中的此偏移量开始。如果 offset 为负，则序列将从 array 中距离末端这么远的地方开始。 
*如果给出了 length 并且为正，则序列中将具有这么多的单元。如果给出了 length 并且为负，则序列将终止在距离数组末端这么远的地方。
*如果省略，则序列将从 offset 开始一直到 array 的末端。 
*注意 array_slice() 默认将重置数组的键。自 PHP 5.0.2 起，可以通过将 preserve_keys 设为 TRUE 来改变此行为。 
*/

$input = array("a", "b", "c", "d", "e");

$output = array_slice($input, 2);      // returns "c", "d", and "e"
$output = array_slice($input, -2, 1);  // returns "d"
$output = array_slice($input, 0, 3);   // returns "a", "b", and "c"

// note the differences in the array keys
print_r(array_slice($input, 2, -1));
print_r(array_slice($input, 2, -1, true));
