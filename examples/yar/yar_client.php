<?php
/**
 * @author: 文江义
 * @date: 19:59 2019/8/19
 */
$client = new Yar_Client("http://localhost:8080/examples/yar/yar_server.php");
/* the following setopt is optinal */
$client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 1000);
$client->SetOpt(YAR_OPT_TIMEOUT, 5000);

$client->SetOpt(YAR_OPT_HEADER, array("hd1: val", "hd2: val"));  //Custom headers, Since 2.0.4
var_dump(123);
/* call remote service */
$result = $client->call('some_method', ["parameter"]);

var_dump($result);
