<?php
/**
 * @author: 文江义
 * @date: 9:42 2019/4/26
 */

class Ping
{
    public function run($ip, $timeout = 1)
    {
        /* create the socket, the last '1' denotes ICMP */
        if (substr(PHP_OS, 0 ,3) == 'WIN') {
            $socket = socket_create(AF_INET, SOCK_RAW, 1);
        } else {
            // Linux 使用 SOCK_DGRAM 并且需要 sudo sysctl -w net.ipv4.ping_group_range='mingid maxgid'
            $socket = socket_create(AF_INET, SOCK_DGRAM, 1);
        }
        /* set socket receive timeout to 1 second */
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, ['sec' => $timeout, 'usec' => 0]);
        
        $delay = false;
        /* ICMP ping packet with a pre-calculated checksum */
        $package = "\x08\x00\x19\x2f\x00\x00\x00\x00\x70\x69\x6e\x67";
        /* connect to socket */
        socket_connect($socket, $ip, null);
        $startTime = msectime();
        socket_send($socket, $package, strlen($package), 0);
        // 读取不到数据不抛出警告
        if (@socket_read($socket, 255)) {
            $delay = msectime() - $startTime;
        }
        socket_close($socket);
        return $delay;
    }
}


$ips = [
    '121.69.70.182',
    '221.218.102.146',
];

$ping = new Ping();
foreach ($ips as $ip) {
    var_dump($ping->run($ip));
}

function msectime()
{
    list($msec, $sec) = explode(' ', microtime());
    return sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
}
