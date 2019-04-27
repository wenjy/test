<?php
/**
array range ( mixed low, mixed high [, number step] )
range() 返回数组中从 low 到 high 的单元，包括它们本身。如果 low > high，则序列将从 high 到 low。 
新参数: 可选的 step 参数是 PHP 5.0.0 新加的。 
如果给出了 step 的值，它将被作为单元之间的步进值。step 应该为正值。如果未指定，step 则默认为 1。
*/

// array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)
foreach (range(0, 12) as $number) {
    echo $number;
}

// The step parameter was introduced in 5.0.0
// array(0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100)
foreach (range(0, 100, 10) as $number) {
    echo $number;
}

// Use of character sequences introduced in 4.1.0
// array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i');
foreach (range('a', 'i') as $letter) {
    echo $letter;
}
// array('c', 'b', 'a');
foreach (range('c', 'a') as $letter) {
    echo $letter;
//在 PHP 版本 4.1.0 到 4.3.2 中，range() 将数字字符串看作字符串而不是整数，因此将会被作为字符序列使用。例如，"4242" 会被当作 "4" 来对待。 
