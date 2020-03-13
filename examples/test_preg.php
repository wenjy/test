<?php
/**
 * @author: 文江义
 * @date: 14:34 2019/12/11
 */
function random($length = 16)
{
    $string = '';

    while (($len = strlen($string)) < $length) {
        $size = $length - $len;

        $bytes = random_bytes($size);

        $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
    }

    return $string;
}
var_dump(file(__DIR__ . DIRECTORY_SEPARATOR . 'test_md5.php'));
exit;
[$usec, $sec] = explode(' ', microtime());
var_dump($usec);
var_dump($sec);
var_dump($sec . substr($usec,2) . mt_rand(10000, 99999));
var_dump(date('YmdHis') . mt_rand(10, 99));
var_dump(random());
var_dump((int)null);
$arr = [1 => '1aa', 2 => 'baa', 3 => 'caa'];
$str = 'aaa:bbb:1213';
$str .= 'b';
var_dump(str_replace('aa', '', $arr));
var_dump($str);
exit;
$type = 1;
switch ($type) {
    case 1:
        var_dump(1);
    case 2:
        var_dump(2);
    case 3:
        var_dump(3);
        var_dump(4);
        break;
}exit;
var_dump(substr($str, strrpos($str, ':') + 1));
if ($a = $arr[1]) {
    echo 1111;
}
var_dump(array_chunk($arr, 5, true));exit;

$start = round(microtime(true) * 1000, 2);
$header = 'HTTP/1.1 404 Not Found';
$header = 'HTTP/1.1 404';
for ($i = 0; $i < 100000; $i++) {
//    preg_match('/(?<version>[^ ]+) (?<status>[^ ]+)[ ]*(?<message>.*)/', $header, $matches);
    $matches = explode(' ', $header, 3);
}
var_dump($matches);
$end = round(microtime(true) * 1000, 2);
echo "1: " . ($end - $start) . "\r\n";
echo memory_get_usage() . "\r\n"; // 389032
