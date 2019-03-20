<?php
/**
 * @author: jiangyi
 * @date: 下午2:43 2019/3/6
 * 固定数组长度，只允许整数范围索引，目的是更快实现数组
 */

// Initialize the array with a fixed length
$array = new SplFixedArray(5);

$array[1] = 2;
$array[4] = "foo";

var_dump($array[0]); // NULL
var_dump($array[1]); // int(2)

var_dump($array["4"]); // string(3) "foo"

// Increase the size of the array to 10
$array->setSize(10);

$array[9] = "asdf";
var_dump($array[9]);

// Shrink the array to a size of 2
$array->setSize(2);

// The following lines throw a RuntimeException: Index invalid or out of range
try {
    var_dump($array["non-numeric"]);
} catch (RuntimeException $re) {
    echo "RuntimeException: " . $re->getMessage() . "\n";
}

try {
    var_dump($array[-1]);
} catch (RuntimeException $re) {
    echo "RuntimeException: " . $re->getMessage() . "\n";
}

try {
    var_dump($array[5]);
} catch (RuntimeException $re) {
    echo "RuntimeException: " . $re->getMessage() . "\n";
}
