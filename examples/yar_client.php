<?php
/**
 * @author: 文江义
 * @date: 18:25 2019/6/11
 */
$url_params = [
    'service' => 'proxy.device',
];
$client = new \Yar_Client('http://www.proxyserver.com/soa' . '?' . http_build_query($url_params));

$auth_key = md5('qnE7rtABekygwveKproxy.device');
$client->setOpt(YAR_OPT_TIMEOUT, 5);
$client->setOpt(YAR_OPT_CONNECT_TIMEOUT, 5000);
$client->setOpt(YAR_OPT_HEADER, ['soa-auth: ' . $auth_key]);

$result = $client->call('tableData', ['skip' => 0, 'take' => 10]);
var_dump($result);
