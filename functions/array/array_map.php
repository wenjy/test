<?php
/**
*array array_map ( callback callback, array arr1 [, array ...] )
*array_map() 返回一个数组，该数组包含了 arr1 中的所有单元经过 callback 作用过之后的单元。
*callback 接受的参数数目应该和传递给 array_map() 函数的数组数目一致。 
*/

function cube($n)
{
    return($n * $n * $n);
}

$a = array(1, 2, 3, 4, 5);
$b = array_map("cube", $a);
var_dump($b);

function show_Spanish($n, $m)
{
    return("The number $n is called $m in Spanish");
}

function map_Spanish($n, $m)
{
    return(array($n => $m));
}

$a = array(1, 2, 3, 4, 5);
$b = array("uno", "dos", "tres", "cuatro", "cinco");

$c = array_map("show_Spanish", $a, $b);
var_dump($c);

$d = array_map("map_Spanish", $a , $b);
var_dump($d);

//通常使用了两个或更多数组时，它们的长度应该相同，因为回调函数是平行作用于相应的单元上的。如果数组的长度不同，则最短的一个将被用空的单元扩充。 

//本函数一个有趣的用法是构造一个数组的数组，这可以很容易的通过用 NULL 作为回调函数名来实现。 

$a = array(1, 2, 3, 4, 5);
$b = array("one", "two", "three", "four", "five");
$c = array("uno", "dos", "tres", "cuatro", "cinco");

$d = array_map(null, $a, $b, $c);
var_dump($d);
