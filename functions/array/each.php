<?php
/**
array each ( array &array )
返回 array 数组中当前指针位置的键／值对并向前移动数组指针。
键值对被返回为四个单元的数组，键名为 0，1，key 和 value。单元 0 和 key 包含有数组单元的键名，1 和 value 包含有数据。 
如果内部指针越过了数组的末端，则 each() 返回 FALSE。
*/
$foo = array("bob", "fred", "jussi", "jouni", "egon", "marliese");
$bar = each($foo);
var_dump($bar);

$foo = array("Robert" => "Bob", "Seppo" => "Sepi");
$bar = each($foo);
var_dump($bar);

$fruit = array('a' => 'apple', 'b' => 'banana', 'c' => 'cranberry');
reset($fruit);
while (list($key, $val) = each($fruit)) {
    echo "$key => $val\n";
}
//在执行 each() 之后，数组指针将停留在数组中的下一个单元或者当碰到数组结尾时停留在最后一个单元。如果要再用 each 遍历数组，必须使用 reset()。
//因为将一个数组赋值给另一个数组时会重置原来的数组指针，因此在上边的例子中如果我们在循环内部将 $fruit 赋给了另一个变量的话将会导致无限循环。 

