<?php
/**
 * @author: 文江义
 * @date: 16:53 2019/5/6
 */

use Swoole\Http\Server;

include_once __DIR__ . '/redis_pool.php';

class SockTcpServer
{
    /**
     * @var Server
     */
    protected $http_server;

    /**
     * @var \Swoole\Server\Port
     */
    protected $tcp_server;

    protected $worker_redis_pool;

    protected $task_redis_pool;

    /**
     * @var array
     */
    protected $config = [
        'reactor_num'              => 2,     // 线程数. 一般设置为CPU核数的1-4倍
        'worker_num'               => 2,    // 工作进程数量. 设置为CPU的1-4倍最合理
        // 防止 PHP 内存溢出, 一个工作进程处理 X 次任务后自动重启 (注: 0,不自动重启)
        'max_request'              => 1000,
        // 此参数用来设置Server最大允许维持多少个TCP连接。超过此数量后，新进入的连接将被拒绝
        'max_connection'                 => 1000,
        'task_worker_num'          => 1,// task 进程数
        //'task_ipc_mode'            => 1,     // 设置 Task 进程与 Worker 进程之间通信的方式。
        //'task_max_request'         => 0,
        'enable_coroutine'=>true,
        'task_enable_coroutine'=>true,
        //'task_tmpdir'              => '/tmp',
        //'message_queue_key'        => ftok(SYS_ROOT . 'queue.msg', 1),
        'dispatch_mode'            => 2,
        'daemonize'                => false,     // 设置守护进程模式
        //'backlog'                  => 128,
        //'log_file'                 => '/data/logs/swoole.log',
        //'heartbeat_check_interval' => 10, // 心跳检测间隔时长(秒)
        //'heartbeat_idle_time'      => 20, // 连接最大允许空闲的时间
        //'open_eof_check'           => 1,
        //'open_eof_split'           => 1,
        //'package_eof'              => "\r\r\n",
        //'open_cpu_affinity'        => 1,
        //'socket_buffer_size'       => 1024 * 1024 * 128,
        //'buffer_output_size'       => 1024 * 1024 * 2,
        //'enable_delay_receive'     => false,
        //'cpu_affinity_ignore' =>array(0,1)//如果你的网卡2个队列（或者没有多队列那么默认是cpu0来处理中断）,并且绑定了core 0和core 1,那么可以通过这个设置避免swoole的线程或者进程绑定到这2个core，防止cpu0，1被耗光而造成的丢包
    ];

    public function __construct(string $host, int $port, $mode = SWOOLE_PROCESS, array $config = [])
    {
        $this->http_server = new Server($host, $port, $mode);

        $this->http_server->on('connect', function (Server $server, int $fd) {
            echo "Client Connect fd[{$fd}]\n";
        });

        // 启动后在主进程（master）的主线程回调此函数
        $this->http_server->on('start', function (Server $server) {
            // onStart回调中，仅允许echo、打印Log、修改进程名称
            $this->setProcessName("swoole_server_master[{$server->master_pid}]");
            echo 'on start event' . PHP_EOL;
        });

        $this->http_server->on('ManagerStart', function (Server $server) {
            $this->setProcessName("swoole_server_manager[{$server->manager_pid}]");
            echo 'on ManagerStart event' . PHP_EOL;
        });

        $this->http_server->on('ManagerStop', function (Server $server) {
            echo 'on ManagerStop event' . PHP_EOL;
        });

        $this->http_server->on('WorkerStart', function (Server $server, int $worker_id){
            $process_name = "swoole_server_worker[{$worker_id}]";
            if ($this->isTaskWorker($server, $worker_id)) {
                $process_name = "swoole_server_task_worker[{$worker_id}]";
            }
            $this->setProcessName($process_name);
            echo 'on WorkerStart event $worker_id->' .$worker_id. PHP_EOL;

            // worker 进程时 协程创建 redis pool
            go(function () use ($server, $worker_id){
                // 设置redis pool
                if (!$this->isTaskWorker($server, $worker_id)) {
                    $this->worker_redis_pool = new RedisPool();
                }
            });

        });

        $this->http_server->on('WorkerStop', function (Server $server, int $worker_id){
            echo 'on WorkerStop event $worker_id->' .$worker_id. PHP_EOL;

            // 释放redis pool
            $this->worker_redis_pool->destruct();
        });

        // 仅在开启reload_async特性后有效
        $this->http_server->on('WorkerExit', function (Server $server, $worker_id){
            echo 'on WorkerExit event $worker_id->' .$worker_id. PHP_EOL;
        });

        $this->http_server->on('shutdown', function (Server $server) {
            echo 'on shutdown event' . PHP_EOL;
        });

        $this->http_server->on('WorkerError', function (Server $server, int $worker_id, int $worker_pid, int $exit_code, int $signal) {
            echo 'on WorkerError' . PHP_EOL;
        });

        /*$this->http_server->on('task', function (Server $server, int $task_id, int $src_worker_id, $data) {
            go(function () {
                // 设置redis pool
                $this->task_redis_pool = new RedisPool();
            });
            echo "New AsyncTask[id=$task_id]".PHP_EOL;
            [$info, $fd] = explode('->',$data,2);
            $this->task_redis_pool->get()->set('swoole_'.$fd, $info);
            //返回任务执行的结果
            $server->finish("$data -> OK");
        });*/

        $this->http_server->on('Task', function (Server $server, Swoole\Server\Task $task) {
            //来自哪个`Worker`进程
            $worker_id = $task->worker_id;
            //任务的编号
            $task_id = $task->id;
            //任务的类型，taskwait, task, taskCo, taskWaitMulti 可能使用不同的 flags
            $task_flag = $task->flags;
            //任务的数据
            $data = $task->data;
            //协程 API
            //co::sleep(0.2);
            //完成任务，结束并返回数据

            [$info, $fd] = explode('->',$data,2);
            echo "New AsyncTask[id=$task_id][fd={$fd}]".PHP_EOL;

            //返回任务执行的结果
            $task->finish("info: $info");
        });

        $this->http_server->on('finish', function (Server $server, int $task_id, string $data) {
            echo 'on finish event' . PHP_EOL;
            echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
        });

        $this->http_server->on('request', function (\Swoole\Http\Request $request, \Swoole\Http\Response $response) {
           go(function () {
               $redis1 = $this->worker_redis_pool->get();
               $redis1->setDefer();
               $redis1->get('swoole_' . 1);
               $redis1->get('swoole_' . 2);

              /* $redis2 = $this->worker_redis_pool->get();
               $redis2->setDefer();
               $redis2->get('swoole_' . 2);*/

               $info1 = $redis1->recv();
               $info2 = $redis1->recv();
               echo 'redis1 get->'.$info1.PHP_EOL;
               echo 'redis2 get->'.$info2.PHP_EOL;

               $this->http_server->send(1, $info1 . PHP_EOL);
               $this->http_server->send(2, $info2 . PHP_EOL);

               $this->worker_redis_pool->put($redis1);
               //$this->worker_redis_pool->put($redis2);
           });

            /*$redis1 = $this->worker_redis_pool->get();
            $info1 = $redis1->get('swoole_' . 1);

            $redis2 = $this->worker_redis_pool->get();
            $info2 = $redis2->get('swoole_' . 2);

            $this->http_server->send(1, $info1 . PHP_EOL);
            $this->http_server->send(2, $info2 . PHP_EOL);

            $this->worker_redis_pool->put($redis1);
            $this->worker_redis_pool->put($redis2);*/

            $response->end('response success');
        });

        $this->tcp_server = $this->http_server->addlistener('0.0.0.0', 9502, SWOOLE_SOCK_TCP);

        $this->tcp_server->on('receive', function (Server $server, int $fd, int $reactor_id, $data) {
            //打印收到的消息
            echo "fromId: [{$reactor_id}] Receive message: $data\n";
            //关闭连接（当然，也可以不关闭）
            //$server->close($fd);

            $redis = $this->worker_redis_pool->get();
            $redis->append('swoole_'.$fd, trim($data, "\r\n"));
            $this->worker_redis_pool->put($redis);
            $server->task($data . '->'. $fd);
        });

        $this->tcp_server->on('close', function (Server $server, int $fd) {
            echo "Client: Close fd[{$fd}]\n";
        });

        $this->http_server->set(array_merge($this->config, $config));
        // 重置配置，heartbeat_check_interval heartbeat_idle_time 无法重置
        $this->tcp_server->set([]);

        $this->http_server->start();
    }

    protected function isTaskWorker(Server $server, int $workerId)
    {
        return $workerId >= $server->setting['worker_num'];
    }

    protected function setProcessName(string $processName)
    {
        if (function_exists('cli_set_process_title')) {
            return cli_set_process_title($processName);
        } elseif (function_exists('swoole_set_process_name')) {
            return swoole_set_process_name($processName);
        }
        return false;
    }
}

new SockTcpServer('127.0.0.1', 9501);

