<?php
/**
*array array_flip ( array trans )
*array_flip() 返回一个反转后的 array，例如 trans 中的键名变成了值，而 trans 中的值成了键名。 
*注意 trans 中的值需要能够作为合法的键名，例如需要是 integer 或者 string。如果值的类型不对将发出一个警告，并且有问题的键／值对将不会反转。 
*如果同一个值出现了多次，则最后一个键名将作为它的值，所有其它的都丢失了。 
*array_flip() 如果失败返回 FALSE。 
*/
$trans = ['a'=>1, 'b'=>2, 'c'=>3];
$trans = array_flip($trans);
var_dump($trans);
//$original = strtr($str, $trans);

$trans = array("a" => 1, "b" => 1, "c" => 2);
$trans = array_flip($trans);
var_dump($trans);
