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

function bytesToSize(int $bytes)
{
    if ($bytes == 0) {
        return '0 B';
    }

    $k = 1024;
    $sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    $i = floor(\log($bytes) / \log($k));
    $num = $bytes / pow($k, $i);
    return round($num, 2) . ' ' . $sizes[$i];
}
$read_buffer = 'qwerty';
$len = 5;
$res = '';
if (!empty($read_buffer)) {
    $buff_len = strlen($read_buffer);
    if ($len > $buff_len) {
        $len -= $buff_len;
    }else {
        // 截取buffer返回
        $res = substr($read_buffer, 0, $len);
        $read_buffer = substr($read_buffer, $len);
    }
}
var_dump($read_buffer, $res, $len);
return;
$arr = [
    'server' => [
        'swoole' => [
            'pid_file' => '/home/www/wwwroot/proxy_forward_server/storage/server.pid'
        ]
    ]
];
echo json_encode($arr);exit;
$arr = [1,3,5,7,5,33,11,224,55,11,2,3,4];
sort($arr);
var_dump($arr);
echo 'lb_' . date('ymd') . mt_rand(10000, 99999);return;
$str = 'abcdefg';
$start = 0;
$send_len = 2;
while ($send = substr($str, $start, $send_len)) {
    var_dump($send);
    $start += $send_len;
}

return;
for ($i = 0;$i<7;$i++) {
    var_dump(date('Y_m_d', strtotime("- $i days")));
}
return;
$packed = chr(127) . chr(0) . chr(0) . chr(1);
for ($i = 0; $i < strlen($packed); $i++) {
    echo ord($packed[$i]);
}
return;
$arr1 = ['a'=>1, 'b'=>2];
$arr2 = ['a'=>3, 'b'=>4];
var_dump($arr1 + $arr2);
return;
$a = dns_get_record("proxy.wen.com", DNS_A);
var_dump($a);return;
$crlf = '\r\n';
$str2 = "v{$crlf}b";
echo str_replace('\r\n', "\r\n", $str2);
echo "a\r\nb";
var_dump(http_build_query(['a' => '\n', 'n' => '\r\n']));
$bytes = 12233;
echo bytesToSize($bytes);
return;

function testForeach()
{
    echo 'call';
    return [1,2,3,4];
}

foreach (testForeach() as $val) {
    echo $val;
}
return;
$str = 'plain';
var_dump(preg_match_all('/[^abc]/', $str, $matches));
var_dump($matches);return;
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
