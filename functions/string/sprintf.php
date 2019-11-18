<?php
/**
 * @author: 文江义
 * @date: 14:24 2019/6/3
 */

$max = 10;
$str = 'abcd';

var_dump(sprintf("%-{$max}s", $str));
var_dump(sprintf("%+{$max}s", $str));
var_dump(sprintf("% {$max}s", $str));
var_dump(sprintf("%0{$max}s", $str));

var_dump(sprintf("%'.9d", 123));
var_dump(sprintf("%'.09d", 123));

// With printf() and sprintf() functions, escape character is not backslash '\' but rather '%'.
var_dump(sprintf('%%%s%%', 'koko')); #output: '%koko%'
