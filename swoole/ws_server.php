<?php

use Swoole\WebSocket\Server;

class Websocket
{
    protected $server;

    protected $config = [
        'reactor_num'              => 2,     // 线程数. 一般设置为CPU核数的1-4倍
        'worker_num'               => 2,    // 工作进程数量. 设置为CPU的1-4倍最合理
        // 防止 PHP 内存溢出, 一个工作进程处理 X 次任务后自动重启 (注: 0,不自动重启)
        'max_request'              => 1000,
        // 此参数用来设置Server最大允许维持多少个TCP连接。超过此数量后，新进入的连接将被拒绝
        'max_connection'                 => 1000,
        //'task_worker_num'          => 2,// task 进程数
        //'task_ipc_mode'            => 1,     // 设置 Task 进程与 Worker 进程之间通信的方式。
        //'task_max_request'         => 0,
        // 防止 PHP 内存溢出
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

    public function __construct(string $host, int $port, array $config = [])
    {
        $this->server = new Server($host, $port);

        // 启动后在主进程（master）的主线程回调此函数
        $this->server->on('start', function (Server $server) {
            // onStart回调中，仅允许echo、打印Log、修改进程名称
            cli_set_process_title("ws_server_master[{$server->master_pid}]");
            echo 'on start event' . PHP_EOL;
        });

        $this->server->on('ManagerStart', function (Server $server) {
            cli_set_process_title("ws_server_manager[{$server->manager_pid}]");
            echo 'on ManagerStart event' . PHP_EOL;
        });

        $this->server->on('ManagerStop', function (Server $server) {
            echo 'on ManagerStop event' . PHP_EOL;
        });

        $this->server->on('WorkerStart', function (Server $server, int $worker_id){
            cli_set_process_title("ws_server_worker[{$worker_id}]");
            echo 'on WorkerStart event $worker_id->' .$worker_id. PHP_EOL;
        });

        $this->server->on('WorkerStop', function (Server $server, int $worker_id){
            echo 'on WorkerStop event $worker_id->' .$worker_id. PHP_EOL;
        });

        // 仅在开启reload_async特性后有效
        $this->server->on('WorkerExit', function (Server $server, $worker_id){
            echo 'on WorkerExit event $worker_id->' .$worker_id. PHP_EOL;
        });

        $this->server->on('shutdown', function (Server $server) {
            echo 'on shutdown event' . PHP_EOL;
        });

        $this->server->on('WorkerError', function (Server $server, int $worker_id, int $worker_pid, int $exit_code, int $signal) {
            echo 'on WorkerError' . PHP_EOL;
        });

        $this->server->on('task', function (Server $server, int $task_id, int $src_worker_id, mixed $data) {
            echo 'on task event' . PHP_EOL;
            echo "New AsyncTask[id=$task_id]".PHP_EOL;
            //返回任务执行的结果
            $server->finish("$data -> OK");
        });

        $this->server->on('finish', function (Server $server, int $task_id, string $data) {
            echo 'on finish event' . PHP_EOL;
            echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
        });

        $this->bindEvent();

       /* $this->server->on('open', function (Server $server, $request) {
            echo "server: handshake success with fd{$request->fd}\n";
        });

        $this->server->on('message', function (Server $server, \Swoole\WebSocket\Frame $frame) {
            echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
            $server->push($frame->fd, "this is server");
        });

        $this->server->on('close', function (Server $server, $fd) {
            echo "client {$fd} closed\n";
        });

        $this->server->on('request', function ($request, $response) {
            // 接收http请求从get获取message参数的值，给用户推送
            // $this->server->connections 遍历所有websocket连接用户的fd，给所有用户推送
            foreach ($this->server->connections as $fd) {
                // 需要先判断是否是正确的websocket连接，否则有可能会push失败
                if ($this->server->isEstablished($fd)) {
                    $this->server->push($fd, $request->get['message']);
                }
            }
        });*/

        $this->server->set(array_merge($this->config, $config));

        $this->server->start();
    }

    protected function bindEvent()
    {
        $this->server->on('open', [$this, 'onOpen']);
        $this->server->on('message', [$this, 'onMessage']);
        $this->server->on('close', [$this, 'onClose']);
        $this->server->on('request', [$this, 'onRequest']);
    }

    public function onOpen(Server $server, $request)
    {
        echo "server: handshake success with fd{$request->fd}\n";
    }

    public function onMessage(Server $server, \Swoole\WebSocket\Frame $frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        $server->push($frame->fd, "this is server");
    }

    public function onClose(Server $server, $fd)
    {
        echo "client {$fd} closed\n";
    }

    public function onRequest(\Swoole\Http\Request $request, \Swoole\Http\Response $response)
    {
        // 接收http请求从get获取message参数的值，给用户推送
        // $this->server->connections 遍历所有websocket连接用户的fd，给所有用户推送
        foreach ($this->server->connections as $fd) {
            // 需要先判断是否是正确的websocket连接，否则有可能会push失败
            if ($this->server->isEstablished($fd)) {
                $this->server->push($fd, $request->get['message']);
            }
        }
    }
}



new Websocket('0.0.0.0', 9502);
