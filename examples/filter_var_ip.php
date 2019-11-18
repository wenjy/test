<?php
/**
 * @author: 文江义
 * @date: 10:05 2019/7/26
 */

$ips = [
    1681916178,
    3083078578,
    1682046953,
    1690520529,
    2060413426,
    3334865116,
];

foreach ($ips as $ip) {
    $ip = long2ip($ip);
    echo $ip . PHP_EOL;
    var_dump(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE));
}
