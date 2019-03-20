<?php
/**
 * @author: jiangyi
 * @date: 下午10:59 2019/3/13
 */

$fp = stream_socket_client("tcp://localhost:8000", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite($fp, "Aloha");
    while (!feof($fp)) {
        var_dump(fgets($fp, 1024));
    }
    fclose($fp);
}
