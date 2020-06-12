<?php

$array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

$ip = '127.0.0.7';
$start = microtime(true);
$a = str_pad('', 1024, 'a');
$b = str_pad('', 1024, 'b');
$c = str_pad('', 1024, 'c');

$filter_headers = [
    'Proxy-Authorization',
    'Proxy-Connection',
    'Transfer-Encoding',
];

$filter_headers_key = [
    'Proxy-Authorization' => true,
    'Proxy-Connection'    => true,
    'Transfer-Encoding'   => true,
];
$a = 'Transfer-Encoding';

$input = [
    'item1'  => 'object1',
    'item2'  => 'object2',
    'item-n' => 'object-n',
];
$empty_arr = [];
$str = 'abcdefg';
$send_len = 2;
for ($i = 0; $i < 1000000; $i++) {
//    $str = '';
//    if (count($array) > 0) {} // 0.017990112304688 389296
//    if ($array) {} // 0.013975143432617 389296
//    if (!$array) {} // 0.016890048980713 389136
//    if (is_null($array)) {} // 0.013534784317017 389136
//    if (!empty($array)) {} // 0.020103931427002 389136
//    if (empty($array)) {} // 0.014135122299194 389136
//    if (in_array($ip, $array1)){}
//    $str = $a . $b . $c; // 0.14716601371765
//    $str = "$a$b$c"; // 0.11545205116272
//    if (in_array($a, $filter_headers)){} // 0.05655312538147
//    if (isset($filter_headers_key[$i])){} // 0.019279956817627
//    if ($a == 'Proxy-Authorization' || $a == 'Proxy-Connection' || $a == 'Transfer-Encoding'){}
    // 0.26763987541199
    /*foreach ($input as $k => $v) {
        $str .= "{$k}: {$v}\r\n";
    }*/

    // 0.55297589302063
   /* $str = implode("\r\n", array_map(
        function ($v, $k) { return "{$k}: {$v}"; },
        $input,
        array_keys($input)
    ));*/
//   foreach ($empty_arr as $value) {} //0.023562908172607
//    if ($empty_arr){foreach ($empty_arr as $value) {}} // 0.017234086990356
   /* $begin_len = 0; // 0.25884604454041
    while ($send = substr($str, $begin_len, $send_len)) {
        $begin_len += $send_len;
    }*/
    $chunk_data = str_split($str, $send_len); // 0.17767119407654
    foreach ($chunk_data as $data) {}
}

$end = microtime(true);
echo "1: " . ($end - $start) . "\n";
echo memory_get_usage() . "\n"; // 389032
