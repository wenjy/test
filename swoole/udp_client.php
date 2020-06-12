<?php
/**
 * @author: 文江义
 * @date: 13:52 2020/4/21
 */

use Swoole\Async\Client;

$tmp = [];
$tmp[] = 0x0000; // RSV: 保留字段，默认X'0000'
$tmp[] = 0x00; // FRAG: 该数据包的片段序号，如果值为X'00'则说明该数据包为独立数据包，如果为1~127的某个值，则说明为整个数据包的一个片段
$tmp[] = 0x01;
$host = '172.16.1.49';
$port = 40003;
$str = 'hello world!';
for ($i = 0; $i < strlen($host); $i++) {
    $tmp[] = ord($host[$i]);
}
$tmp[] = pack('n', $port);

for ($i = 0; $i < strlen($str); $i++) {
    $tmp[] = ord($str[$i]);
}
//                $cli->send(pack('C*', ...$tmp));
/*Co\run(function() use ($host, $port, $tmp){
    $client = new Swoole\Coroutine\Client(SWOOLE_SOCK_UDP);
    if (!$client->connect($host, $port, 0.5))
    {
        echo "connect failed. Error: {$client->errCode}\n";
    }
    $res = $client->send(pack('C*', ...$tmp));
    var_dump($res);
});*/

$udpClient = new Client(SWOOLE_SOCK_UDP);

$udpClient->on('connect', function (Client $cli) {
    var_dump(12312312);
    $cli->send('tttt');
    usleep(1000);
    $udpClient1 = new Client(SWOOLE_SOCK_UDP);
    $udpClient1->on('connect', function (Client $cli) {
        var_dump(12312312);
        $cli->send('tttt2');

    });
    $udpClient1->on('receive', function (Client $cli, $data) {
        var_dump($data);
    });
    $res = $udpClient1->connect('172.16.1.49', 40001, 1);
});
$udpClient->on('receive', function (Client $cli, $data) {
    var_dump($data);
});

$res = $udpClient->connect($host, $port, 1);
Swoole\Event::wait();
var_dump($res);
