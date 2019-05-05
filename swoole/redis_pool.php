<?php
/**
 * @author: 文江义
 * @date: 14:04 2019/4/29
 *
 * @see https://github.com/swoole/swoole-src/issues/2035
 */

$pool = new RedisPool();
$server = new Swoole\Http\Server('127.0.0.1', 9501);
$server->set([
    // 如开启异步安全重启, 需要在workerExit释放连接池资源
    'reload_async'     => true,
    // 开启守护进程
    'daemonize'        => false,
    // 开启协程
    'enable_coroutine' => true,
    // 连接处理线程数
    'reactor_num'      => 2,
    // 工作进程数
    'worker_num'       => 2,
    // PID 文件
    'pid_file'         => __DIR__ . '/test.pid',
    // 日志文件路径
    'log_file'         => __DIR__ . '/test.log',
    // 进程的最大任务数
    'max_request'      => 10000,
    // 退出等待时间
    'max_wait_time'    => 30,
    // 日志级别
    'log_level'        => 5,
]);
$server->on('start', function (swoole_http_server $server) {
    echo "MasterPid={$server->master_pid}|Manager_pid={$server->manager_pid}\n";
    echo "Server: start.Swoole version is [" . SWOOLE_VERSION . "]\n";
});
$server->on('workerExit', function (swoole_http_server $server) use ($pool) {
    go(function () use ($pool) {
        $pool->destruct();
    });
});
$server->on('request', function (swoole_http_request $req, swoole_http_response $resp) use ($pool) {
    //从连接池中获取一个Redis协程客户端
    $redis = $pool->get();
    //连接失败
    if ($redis === false) {
        $resp->end("ERROR");
        return;
    }
    $result = $redis->hgetall('key');
    $resp->end(var_export($result, true));
    //释放客户端，其他协程可复用此对象
    $pool->put($redis);
});
$server->start();

class RedisPool
{
    protected $available = true;
    protected $pool;

    public function __construct()
    {
        $this->pool = new SplQueue;
    }

    public function put($redis)
    {
        $this->pool->push($redis);
    }

    /**
     * @return bool|mixed|\Swoole\Coroutine\Redis
     */
    public function get()
    {
        //有空闲连接且连接池处于可用状态
        if ($this->available && count($this->pool) > 0) {
            return $this->pool->pop();
        }

        //无空闲连接，创建新连接
        $redis = new Swoole\Coroutine\Redis();
        $res = $redis->connect('127.0.0.1', 6379);
        if ($res == false) {
            return false;
        } else {
            return $redis;
        }
    }

    public function destruct()
    {
        // 连接池销毁, 置不可用状态, 防止新的客户端进入常驻连接池, 导致服务器无法平滑退出
        $this->available = false;
        while (!$this->pool->isEmpty()) {
            $this->pool->pop();
        }
    }
}
