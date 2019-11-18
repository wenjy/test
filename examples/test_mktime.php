<?php
/**
 * @author: 文江义
 * @date: 10:57 2019/11/13
 */
$time = mktime(0,0,0,date('m'),date('d')-1,date('Y'));

echo date('Y-m-d H:i:s', $time);

$start = 1573488000;
$end = 1573574399;
var_dump(1573557913 - $start);
var_dump($end - 1573557922);
$url = 'http://cdn.faceesy.com/d/uploads/2019052304491023.apk';
var_dump(parse_url($url, PHP_URL_PATH));
var_dump(pathinfo($url, PATHINFO_BASENAME));

$arr = [
    'device_id' => 1,
    'status' => 0,
    'log_at' => 123456,
];

foreach ($arr as $k => $v) {
    unset($arr[$k]);
}

var_dump(implode(':', $arr));
var_dump(strtotime('yesterday'));
var_dump($time);
var_dump(explode(',', '*'));
