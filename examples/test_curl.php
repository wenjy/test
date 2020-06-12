<?php

function curlRequest($url)
{
    $ch = curl_init();
    $options = [
        CURLOPT_URL               => $url,
        CURLOPT_HEADER            => 0,
        CURLOPT_USERAGENT         => 'MozillaXYZ/1.0',
        CURLOPT_CONNECTTIMEOUT    => 3,
        CURLOPT_RETURNTRANSFER    => 1,
    ];

    curl_setopt_array($ch, $options);

    $rec_data = curl_exec($ch);
    // 检查是否有错误发生
    if (curl_errno($ch)) {
        echo 'curlRequest error: ' . curl_error($ch) . PHP_EOL;
    }
    curl_close($ch);

    return $rec_data;
}

function proxyCurlRequest($url, $proxy_ip, $proxy_port, $username = null, $password = null, $protocol = 'http')
{
    $ch = curl_init();
    $options = [
        CURLOPT_URL               => $url,
        CURLOPT_PROXYAUTH         => CURLAUTH_BASIC,
        CURLOPT_PROXYTYPE         => $protocol == 'socks5' ? CURLPROXY_SOCKS5 : CURLPROXY_HTTP,
        CURLOPT_PROXY             => $proxy_ip,
        CURLOPT_PROXYPORT         => $proxy_port,
        CURLOPT_HEADER            => 0,
        CURLOPT_USERAGENT         => 'MozillaXYZ/1.0',
        CURLOPT_CONNECTTIMEOUT    => 3,
        CURLOPT_RETURNTRANSFER    => 1,
    ];
    if ($username || $password) {
        $options[CURLOPT_PROXYUSERPWD] = "{$username}:{$password}";
    }
    if ($protocol == 'http') {
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
    }
    curl_setopt_array($ch, $options);

    $rec_data = curl_exec($ch);
    // 检查是否有错误发生
    if (curl_errno($ch)) {
        echo 'curlRequest error: ' . curl_error($ch) . PHP_EOL;
    }
    curl_close($ch);

    return $rec_data;
}

$int32 = 2 << 30;

echo $int32 / 1024 /1024 /10;

$str = 'q:w:e';

[$arr['a'], $arr['b'], $arr['c'], $arr['d']] = explode(':', $str, 4);
var_dump($arr);
$activation_time = '2020-04-15';
$expire_time = null;
$expire_time = $expire_time ?: date('Y-m-d 23:59:59', strtotime($activation_time . ' +' . (2 - 1) . ' days'));
var_dump($expire_time);
