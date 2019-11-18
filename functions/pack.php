<?php
/**
 * @author: 文江义
 * @date: 19:46 2019/6/3
 */

$username = 'abcqwaaaaqqqwe';
$username_len = strlen($username);
$password = 'adfqqq_asdf';
$password_len = strlen($password);
$tmp[] = 0x05;
$tmp[] = $username_len;

for ($i = 0; $i < $username_len; $i++) {
    $tmp[] = ord($username[$i]);
}

$tmp[] = $password_len;

for ($i = 0; $i < $password_len; $i++) {
    $tmp[] = ord($password[$i]);
}

$data = pack('C*', ...$tmp);


/*$info = unpack("H2flag/H2u_length", $data);
var_dump($info);
$length_username = hexdec($info['u_length']) * 2;
$info2 = unpack("H2flag/H2u_length/H{$length_username}username/H2p_length/H*password", $data);

$username = hex2bin($info2['username']);
$password = hex2bin($info2['password']);

var_dump($username, $password);exit;*/

$user_length = unpack('C', $data[1]);
var_dump($user_length);
//$header_info = unpack('C1version/C1cmd/C1rsv/C1atyp', substr($data, 0, 4));
//var_dump($header_info);
$version = unpack('C', $data[0]);

$username = substr($data, 2, $user_length[1]);
$password = substr($data, 3 + $user_length[1]);
var_dump($version[1] == 0x05);
var_dump($version, $username, $password);
exit;
$data = [
    'channel_mark' => 'a',
    'mac' => 'a:b:c:d:e',
    'token' => '123456',
];
$str = json_encode($data);

var_dump('device:' . md5($data['channel_mark'].$data['mac']) . ':token');

$pack = pack('N3', '1001', 0, strlen($str)) . $str;

list(1 => $command, 2 => $encrypt, 3 => $length) = unpack('N3', $pack);

var_dump($data, $command,$encrypt,$length);

$body = substr($pack, 12);
echo "server received data: {$body}\n";

function district(string $location_name, int $city_id)
{
    $pos = strpos($location_name, '市');

    if ($pos !== false) {
        $district_name = substr($location_name, $pos + 3); // urf8中文需要加3个字节

        return md5($city_id.$district_name);
    }

    return false;
}

var_dump(district('湖北省武汉市江夏区', 420100));

var_dump(date('Y-m-d', strtotime('-15 days')));

$uniqueFd = 'aaaaa-12';
if (($pos = strrpos($uniqueFd, '-')) !== false) {
    var_dump(substr($uniqueFd, $pos + 1));
}




$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, ['sec' => 10, 'usec' => 0]);

$data = [
    'channel_mark' => 'a',
    'mac' => 'a:b:c:d:e',
    'token' => '123456',
];
$str = json_encode($data);
$pack = pack('N3', '1001', 0, strlen($str)) . $str;

socket_connect($socket, '127.0.0.1', 9502);
socket_send($socket, $pack, strlen($pack), 0);

// 读取不到数据不抛出警告
if ($data = @socket_read($socket, 10000)) {
    list(1 => $command, 2 => $encrypt, 3 => $length) = unpack('N3', $data);
    $body = substr($data, 12);
    echo $body;
}
socket_close($socket);


$data = [
    'channel_mark' => 'a',
    'mac' => 'a:b:c:d:e',
    'token' => '123456',
];
