<?php
$ip_info = [
    'country_id' => 'CN',
    'province_id' => 370000,
    'city_id' => 371500,
    'district_id' => 371581,
    'isp_id' => 100026,
];
//var_dump(file_get_contents('http://redisdoc.com/set/index.html'));return;
if (($socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)) == FALSE) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    exit("创建socekt失败: [$errorcode] $errormsg");
}
echo "socket 创建成功...\n";
$input = 'aaaa';
$host = '172.16.1.49';
$port = 40010;
while (true) {
    if (!socket_sendto($socket, $input, strlen($input), 0, $host, $port)) {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);
        echo "Could not send data: [$errorcode] $errormsg \n";
        break;
    }
    if (socket_recvfrom($socket, $reply, 1024, 0, $host, $port) === false) {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);
        echo "Could not receive data: [$errorcode] $errormsg \n";
        break;
    }
    echo "Reply : $reply\n";

    // 第二次发送
   if (!socket_sendto($socket, $input, strlen($input), 0, $host, $port)) {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);
        echo "Could not send data: [$errorcode] $errormsg \n";
        break;
    }
    echo 2 . PHP_EOL;
    if (socket_recvfrom($socket, $reply, 2024, 0, $host, $port) === false) {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);
        echo "Could not receive data: [$errorcode] $errormsg \n";
        break;
    }

    echo "Reply : $reply\n";
 
    break;
}
socket_close($socket);
