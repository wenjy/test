<?php
/**
void list ( mixed varname, mixed ... )
像 array() 一样，这不是真正的函数，而是语言结构。list() 用一步操作给一组变量进行赋值。 
注意: list() 仅能用于数字索引的数组并假定数字索引从 0 开始。
*/
$info = array('coffee', 'brown', 'caffeine');

// Listing all the variables
list($drink, $color, $power) = $info;
echo "$drink is $color and $power makes it special.\n";

// Listing some of them
list($drink, , $power) = $info;
echo "$drink has $power.\n";

// Or let's skip to only the third one
list( , , $power) = $info;
echo "I need $power!\n";

//list() 从最右边一个参数开始赋值。如果你用单纯的变量，不用担心这一点。
//但是如果你用了具有索引的数组，通常你期望得到的结果和在 list() 中写的一样是从左到右的，但实际上不是。是以相反顺序赋值的。