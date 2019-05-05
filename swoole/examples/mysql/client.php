<?php
/**
 * @author: 文江义
 * @date: 14:55 2019/4/29
 */

go(function () {
    $swoole_mysql = new Co\MySQL();
    $swoole_mysql->connect([
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'root',
        'password' => '123456',
        'database' => 'test',
    ]);
    $res = $swoole_mysql->query('show tables');
    var_dump($res);
});

class Abc
{
    /**
     * 设置执行超时时间
     * @param int $exec_time 执行超时时间，单位秒
     * @param int $connect_time 连接超时时间，单位毫秒
     * @return $this
     */
    protected function setTimeout(int $exec_time, int $connect_time = 50)
    {
        $this->server_info['client_options'][YAR_OPT_TIMEOUT] = $exec_time;
        $this->server_info['client_options'][YAR_OPT_CONNECT_TIMEOUT] = $connect_time;
        return $this;
    }
}

