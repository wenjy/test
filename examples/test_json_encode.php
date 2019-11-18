<?php
/**
 * @author: 文江义
 * @date: 14:17 2019/7/31
 */
$array = ['66d87c708a7ae7e8047a9b85916a786f', '66d87c708a7ae7e8047a9b85916a786f'];

$start = microtime(true);
for ($i = 0; $i < 1000000; $i++) {
    //$str = json_encode($array);
    //$array1 = json_decode($str, true);
    $str = implode(',', $array);
    $array1 = explode(',', $str);
}
$end = microtime(true);
echo "1: " . ($end - $start) . "\n";
echo memory_get_usage() . "\n"; // 389032
