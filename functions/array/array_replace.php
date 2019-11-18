<?php
/**
 * @author: 文江义
 * @date: 14:52 2019/6/3
 * 函数使用后面数组元素相同 key 的值替换 array1 数组的值。
 * 如果一个键存在于第一个数组同时也存在于第二个数组，它的值将被第二个数组中的值替换。
 * 如果一个键存在于第二个数组，但是不存在于第一个数组，则会在第一个数组中创建这个元素。
 * 如果一个键仅存在于第一个数组，它将保持不变。
 * 如果传递了多个替换数组，它们将被按顺序依次处理，后面的数组将覆盖之前的值
 */

$base = array("orange", "banana", "apple", "raspberry");
$replacements = array(0 => "pineapple", 4 => "cherry");
$replacements2 = array(0 => "grape");

$basket = array_replace($base, $replacements, $replacements2);
var_dump($basket);
