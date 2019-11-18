<?php
/**
 * @author: 文江义
 * @date: 16:52 2019/9/3
 */

$start = microtime(true);
//$socket = stream_socket_server("tcp://0.0.0.0:8001", $errno, $errstr);

$socket1 = stream_socket_server("udp://0.0.0.0:8001", $errno, $errstr, STREAM_SERVER_BIND);
$socket2 = stream_socket_server("udp://0.0.0.0:8002", $errno, $errstr, STREAM_SERVER_BIND);
fclose($socket1);
fclose($socket2);
$end = microtime(true);
echo "1: " . ($end - $start) . "\n";
echo memory_get_usage() . "\n"; // 389032
