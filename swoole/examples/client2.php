<?php
$clients = [];
for ($i = 0; $i < 1; $i++) {
    $client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC); //同步阻塞
    $ret = $client->connect('127.0.0.1', 9501, 0.5, 0);
    if (!$ret) {
        echo "Over flow. errno=" . $client->errCode;
        die("\n");
    } else {
        echo "#$i\tConnect success.  sock=" . $client->sock . PHP_EOL;
    }
    $clients[] = $client;
}
sleep(1);
while (1) {
    foreach ($clients as $client) {
        $client->send("sss");
        $data = $client->recv();
        var_dump($data);
    }
    sleep(1);
}
