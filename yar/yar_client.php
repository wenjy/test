<?php
/**
 * @author: 文江义
 * @date: 11:35 2019/4/24
 */
try {
    $client = new yar_client('http://www.local.com/yar_server.php');
    //var_dump($client);exit;
    /* call directly */
    //var_dump($client->add(1, 2));

    /* call via call */
    var_dump($client->call("add", [3, 2]));


    /* __add can not be called */
    //var_dump($client->_add(1, 2));
} catch (Exception $e) {
    echo $e->getTraceAsString();
}
