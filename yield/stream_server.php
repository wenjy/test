<?php
/**
 * @author: jiangyi
 * @date: 下午10:56 2019/3/13
 */

$socket = stream_socket_server("tcp://localhost:8000", $errno, $errstr);
if (!$socket) {
    echo "$errstr ($errno)<br />\n";
} else {
    while ($conn = stream_socket_accept($socket)) {
        fwrite($conn, 'The local time is ' . date('n/j/Y g:i a') . "\n");
        fclose($conn);
    }
    fclose($socket);
}
