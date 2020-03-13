<?php

$array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

$ip = '127.0.0.7';
$start = microtime(true);
$a = 'a';
$b = 'b';
$c = 'c';
for ($i = 0; $i < 1000000; $i++) {
//    if (count($array) > 0) {} // 0.017990112304688 389296
    if ($array) {} // 0.013975143432617 389296
//    if (!$array) {} // 0.016890048980713 389136
//    if (is_null($array)) {} // 0.013534784317017 389136
//    if (!empty($array)) {} // 0.020103931427002 389136
//    if (empty($array)) {} // 0.014135122299194 389136
//    if (in_array($ip, $array1)){}
//    $str = $a . $b . $c; // 0.039223194122314
//    $str = "$a$b$c"; // 0.040318012237549
}
$end = microtime(true);
echo "1: " . ($end - $start) . "\n";
echo memory_get_usage() . "\n"; // 389032
