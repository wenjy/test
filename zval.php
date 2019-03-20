<?php
/**
 * php7的机制不一样了.
 * User: jiangyi
 * Date: 2017/10/12
 * Time: 上午8:37
 */

$a = 'string';
xdebug_debug_zval('a');

//把一个变量赋值给另一变量将增加引用次数(refcount).
$b = $a;
xdebug_debug_zval('a');
$c = &$a;
xdebug_debug_zval('a');
