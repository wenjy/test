<?php
/**
 * @author: jiangyi
 * @date: 下午3:44 2018/11/15
 */

$arr = [
    ['a' => 1],
    ['a' => 2],
    ['a' => 3],
    ['a' => 4],
];
$num = 1;
foreach ($arr as &$val) {
    $val['a'] += 1;
}
var_dump($arr);
foreach ($arr as $key => $val1) {
    var_dump($val1);
}

