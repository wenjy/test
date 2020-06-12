<?php

$config = [
    'reactor_num'        => 4,
    // 线程数. 一般设置为CPU核数的1-4倍
    'worker_num'         => 2,
    // 工作进程数量. 设置为CPU的1-4倍最合理
    // 防止 PHP 内存溢出, 一个工作进程处理 X 次任务后自动重启 (注: 0,不自动重启)
    // 此参数用来设置Server最大允许维持多少个TCP连接。超过此数量后，新进入的连接将被拒绝
    'max_connection'     => 100000,
    'task_worker_num'    => 2,
    // task 进程数
//  'task_ipc_mode'            => 2,     // 设置 Task 进程与 Worker 进程之间通信的方式。
    // 防止 PHP 内存溢出
    //'task_tmpdir'              => '/tmp',
    //'message_queue_key'        => ftok(SYS_ROOT . 'queue.msg', 1),
    'dispatch_mode'      => 2,
    'daemonize'          => false,
    // 设置守护进程模式
    'backlog'            => 5120,
    'log_file'           => '/home/www/swoole.log',
    //'heartbeat_check_interval' => 10,
    // 心跳检测间隔时长(秒)
    //'heartbeat_idle_time'      => 20,
    // 连接最大允许空闲的时间
    //'open_eof_check'           => 1,
    //'open_eof_split'           => 1,
    //'package_eof'              => "\r\r\n",
    //'open_cpu_affinity'        => 1,
    'socket_buffer_size' => 1024 * 1024 * 2,
    'buffer_output_size' => 1024 * 1024 * 2,
    'enable_coroutine'  => true,
    'max_coroutine' => 30,
    //'enable_delay_receive'     => true,
    //'cpu_affinity_ignore' =>array(0,1)//如果你的网卡2个队列（或者没有多队列那么默认是cpu0来处理中断）,并且绑定了core 0和core 1,那么可以通过这个设置避免swoole的线程或者进程绑定到这2个core，防止cpu0，1被耗光而造成的丢包
];

class MyServer
{
    protected $swoole;

    public function __construct(array $config)
    {
        // 基本模式
        //$mode = SWOOLE_BASE;
        // 多进程模式（默认）
        $mode = SWOOLE_PROCESS;
        //创建Server对象，监听 127.0.0.1:9501端口
        $this->swoole = new \Swoole\Server('127.0.0.1', 9100, $mode, SWOOLE_SOCK_TCP);

        $this->swoole->set($config);
        $this->bindEvent();

        $num = 3;
        $ips = ['127.0.0.1', '127.0.0.2'];

        for ($i = 0; $i < $num; $i++) {
            foreach ($ips as $ip) {
                $port = $this->swoole->addlistener($ip, 0, SWOOLE_SOCK_TCP);
            }
        }

        $port = $this->swoole->addlistener('127.0.0.1', 9101, SWOOLE_SOCK_UDP);
        $port->set([]);
        $port->on('Packet', [$this, 'onPacket']);
    }

    protected function bindEvent()
    {
        $this->swoole->on('Start', [$this, 'onStart']);
        $this->swoole->on('Shutdown', [$this, 'onShutdown']);
        $this->swoole->on('ManagerStart', [$this, 'onManagerStart']);
        $this->swoole->on('ManagerStop', [$this, 'onManagerStop']);
        $this->swoole->on('WorkerStart', [$this, 'onWorkerStart']);
        $this->swoole->on('WorkerStop', [$this, 'onWorkerStop']);
        $this->swoole->on('WorkerError', [$this, 'onWorkerError']);
        $this->swoole->on('PipeMessage', [$this, 'onPipeMessage']);

        $this->swoole->on('Finish', [$this, 'onFinish']);
        $this->swoole->on('Task', [$this, 'onTask']);
        $this->swoole->on('Close', [$this, 'onClose']);
        $this->swoole->on('Packet', [$this, 'onPacket']);
        $this->swoole->on('Receive', [$this, 'onReceive']);
        $this->swoole->on('Connect', [$this, 'onConnect']);
    }

    public function run()
    {
        $this->swoole->start();
    }

    public function onFinish($serv, int $task_id, string $data)
    {
        echo 'on finish event' . PHP_EOL;
        echo "AsyncTask[$task_id] Finish: $data" . PHP_EOL;
    }

    public function onTask($serv, int $task_id, int $src_worker_id, mixed $data) {
        echo 'on task event' . PHP_EOL;
        echo "New AsyncTask[id=$task_id]" . PHP_EOL;
        //返回任务执行的结果
        $serv->finish("$data -> OK");
    }

    public function onClose($serv, $fd, $reactorId) {
        echo "Client: Close.\n";
    }

    public function onWorkerError($serv, int $worker_id, int $worker_pid, int $exit_code, int $signal) {
        echo 'on WorkerError' . PHP_EOL;
    }

    public function onPipeMessage($server, int $src_worker_id, mixed $message) {
        echo 'on PipeMessage $src_worker_id->' . $src_worker_id . PHP_EOL;
    }

    public function onPacket($server, string $data, array $client_info) {
        echo 'on Packet' . PHP_EOL;
        $server->sendto($client_info['address'], $client_info['port'], "Server ".$data);
        var_dump($client_info);
    }

    public function onReceive($serv, $fd, $reactorId, $data) {
        echo 'on receive $reactorId->' . $reactorId . PHP_EOL;

        //投递异步任务
        #$task_id = $serv->task($data);
        #echo "Dispath AsyncTask: id=$task_id\n";
        for ($i =1;$i <= 40; $i++) {
            Swoole\Timer::after(2 * 1000, function () {
                co::sleep(1);
                echo 'after Timer' . PHP_EOL;
            });
        }
    }

    public function onConnect($serv, $fd, int $reactorId) {
        echo 'on connect $reactorId->' . $reactorId . PHP_EOL;
    }

    public function onShutdown($serv) {
        echo 'on shutdown event' . PHP_EOL;
    }

    public function onWorkerStop($serv, $worker_id) {
        echo 'on WorkerStop event $worker_id->' . $worker_id . PHP_EOL;
    }

    public function onWorkerStart($serv, $worker_id) {
        echo 'on WorkerStart event $worker_id->' . $worker_id . PHP_EOL;
        if ($worker_id >= $serv->setting['worker_num']) {
            $process = 'testswoole task worker';
        } else {
            $process = 'testswoole worker';
        }
        cli_set_process_title($process);
    }

    public function onManagerStop ($serv) {
        echo 'on ManagerStop event' . PHP_EOL;
    }

    public function onManagerStart($serv) {
        echo 'on ManagerStart event' . PHP_EOL;
        cli_set_process_title('testswoole manager');
        foreach ($serv->ports as $idx => $port) {
            if ($idx == 0) {
                continue;
            }
            $port->on('Receive', function ($serv, $fd, $reactorId, $data) {
                echo 'Receive:'.$data;
            });
        }
    }

    public function onStart($serv) {
        // onStart回调中，仅允许echo、打印Log、修改进程名称
        echo 'on start event' . PHP_EOL;
        cli_set_process_title('testswoole master');
    }
}

$server = new MyServer($config);
$server->run();
