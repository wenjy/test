<?php
/**
*array array_chunk ( array input, int size [, bool preserve_keys] )
*array_chunk() 将一个数组分割成多个数组，其中每个数组的单元数目由 size 决定。最后一个数组的单元数目可能会少几个。
*得到的数组是一个多维数组中的单元，其索引从零开始。 
*将可选参数 preserve_keys 设为 TRUE，可以使 PHP 保留输入数组中原来的键名。如果你指定了 FALSE，那每个结果数组将用从零开始的新数字索引。默认值是 FALSE。
*/

$input_array = array('a'=>'a', 'b'=>'b', 'c'=>'c', 'd'=>'d', 'e'=>'e');
var_dump(array_chunk($input_array, 2));
var_dump(array_chunk($input_array, 2, true));