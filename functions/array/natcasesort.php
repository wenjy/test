<?php
/**
bool natcasesort ( array &array )
本函数实现了一个和人们通常对字母数字字符串进行排序的方法一样的排序算法并保持原有键／值的关联，这被称为“自然排序”。 
如果成功则返回 TRUE，失败则返回 FALSE。 
natcasesort() 是 natsort() 函数的不区分大小写字母的版本。
*/
$array1 = $array2 = array('IMG0.png', 'img12.png', 'img10.png', 'img2.png', 'img1.png', 'IMG3.png');

sort($array1);
echo "Standard sorting\n";
var_dump($array1);

natcasesort($array2);
echo "\nNatural order sorting (case-insensitive)\n";
var_dump($array2);

/**
bool natsort ( array &array )
本函数实现了一个和人们通常对字母数字字符串进行排序的方法一样的排序算法并保持原有键／值的关联，这被称为“自然排序”。
本算法和通常的计算机字符串排序算法（用于 sort()）的区别见下面示例。 
如果成功则返回 TRUE，失败则返回 FALSE。
*/
$array1 = $array2 = array("img12.png", "img10.png", "img2.png", "img1.png");

sort($array1);
echo "Standard sorting\n";
var_dump($array1);

natsort($array2);
echo "\nNatural order sorting\n";
var_dump($array2);
