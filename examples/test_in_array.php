<?php

class TestAS
{

}
var_dump('2019-11-16 17:21:35' < '2019-11-15 17:21:35');exit;
var_dump(empty((new TestAS())->aaaa[0]->aaa));
exit;
$str = '127.0.0.1,127.0.0.2,127.0.0.3,127.0.0.4,127.0.0.5,127.0.0.6,127.0.0.7';
$array1  = explode(',', $str);

$ip = '127.0.0.7';
$start = microtime(true);
for ($i = 0; $i < 1000000; $i++) {
//    if (in_array($ip, $array1)){}
    if (strpos($str, $ip) !== false){}
}
$end = microtime(true);
echo "1: " . ($end - $start) . "\n";
