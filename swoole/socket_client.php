<?php
/**
 * @author: 文江义
 * @date: 16:46 2020/3/19
 */

use Swoole\Coroutine\Socket;

$socket = new Socket(AF_INET, SOCK_STREAM, 0);

go(function () use ($socket) {
    $retval = $socket->connect('127.0.0.1', 9999);
    while ($retval)
    {
        $n = $socket->send(0b1);
        var_dump($n);
        $socket->close();
        return;
        $data = $socket->recv();
        var_dump($data);

        if (empty($data)) {//发生错误或对端关闭连接，本端也需要关闭
            $socket->close();
            break;
        }
        co::sleep(1.0);
    }
    var_dump($retval, $socket->errCode);
});
