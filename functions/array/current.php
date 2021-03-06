<?php
/**
mixed current ( array &array )
每个数组中都有一个内部的指针指向它“当前的”单元，初始指向插入到数组中的第一个单元。 
current() 函数返回当前被内部指针指向的数组单元的值，并不移动指针。如果内部指针指向超出了单元列表的末端，current() 返回 FALSE。 

*/
//如果数组包含有空的单元（0 或者 ""，空字符串）则本函数在碰到这个单元时也返回 FALSE。这使得用 current() 不可能判断是否到了此数组列表的末端。
//要正确遍历可能含有空单元的数组，用 each() 函数。 

$transport = array('foot', 'bike', 'car', 'plane');
$mode = current($transport); // $mode = 'foot';
$mode = next($transport);    // $mode = 'bike';
$mode = current($transport); // $mode = 'bike';
$mode = prev($transport);    // $mode = 'foot';
$mode = end($transport);     // $mode = 'plane';
$mode = current($transport); // $mode = 'plane';

