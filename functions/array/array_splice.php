<?php
/**
array array_splice ( array &input, int offset [, int length [, array replacement]] )
array_splice() 把 input 数组中由 offset 和 length 指定的单元去掉，如果提供了 replacement 参数，则用 replacement 数组中的单元取代。
返回一个包含有被移除单元的数组。注意 input 中的数字键名不被保留。 
如果 offset 为正，则从 input 数组中该值指定的偏移量开始移除。如果 offset 为负，则从 input 末尾倒数该值指定的偏移量开始移除。 
如果省略 length，则移除数组中从 offset 到结尾的所有部分。如果指定了 length 并且为正值，则移除这么多单元。
如果指定了 length 并且为负值，则移除从 offset 到数组末尾倒数 length 为止中间所有的单元。
小窍门：当给出了 replacement 时要移除从 offset 到数组末尾所有单元时，用 count($input) 作为 length。 
如果给出了 replacement 数组，则被移除的单元被此数组中的单元替代。
如果 offset 和 length 的组合结果是不会移除任何值，则 replacement 数组中的单元将被插入到 offset 指定的位置。注意替换数组中的键名不保留。
如果用来替换的值只是一个单元，那么不需要给它加上 array()，除非该单元本身就是一个数组。 
以下表达式以同样方式修改了 $input： 
*/

$input = array("red", "green", "blue", "yellow");
array_splice($input, 2);
// $input is now array("red", "green")
var_dump($input);

$input = array("red", "green", "blue", "yellow");
array_splice($input, 1, -1);
// $input is now array("red", "yellow")
var_dump($input);

$input = array("red", "green", "blue", "yellow");
array_splice($input, 1, count($input), "orange");
// $input is now array("red", "orange")
var_dump($input);

$input = array("red", "green", "blue", "yellow");
array_splice($input, -1, 1, array("black", "maroon"));
// $input is now array("red", "green",
//          "blue", "black", "maroon")
var_dump($input);

$input = array("red", "green", "blue", "yellow");
array_splice($input, 3, 0, "purple");
// $input is now array("red", "green",
//          "blue", "purple", "yellow");
var_dump($input);