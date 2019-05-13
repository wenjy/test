<?php

$config = [
    'reactor_num'              => 4,     // 线程数. 一般设置为CPU核数的1-4倍
    'worker_num'               => 2,    // 工作进程数量. 设置为CPU的1-4倍最合理
    // 防止 PHP 内存溢出, 一个工作进程处理 X 次任务后自动重启 (注: 0,不自动重启)
    'max_request'              => 1000,
    // 此参数用来设置Server最大允许维持多少个TCP连接。超过此数量后，新进入的连接将被拒绝
    'max_connection'                 => 10000,
    'task_worker_num'          => 2,// task 进程数
//  'task_ipc_mode'            => 2,     // 设置 Task 进程与 Worker 进程之间通信的方式。
    'task_max_request'         => 0,
    // 防止 PHP 内存溢出
    //'task_tmpdir'              => '/tmp',
    //'message_queue_key'        => ftok(SYS_ROOT . 'queue.msg', 1),
    'dispatch_mode'            => 2,
    'daemonize'                => false,     // 设置守护进程模式
    'backlog'                  => 128,
    //'log_file'                 => '/data/logs/swoole.log',
    'heartbeat_check_interval' => 10,
    // 心跳检测间隔时长(秒)
    'heartbeat_idle_time'      => 20,
    // 连接最大允许空闲的时间
    //'open_eof_check'           => 1,
    //'open_eof_split'           => 1,
    //'package_eof'              => "\r\r\n",
    //'open_cpu_affinity'        => 1,
    'socket_buffer_size'       => 1024 * 1024 * 128,
    'buffer_output_size'       => 1024 * 1024 * 2,
    'enable_delay_receive'     => true,
    //'cpu_affinity_ignore' =>array(0,1)//如果你的网卡2个队列（或者没有多队列那么默认是cpu0来处理中断）,并且绑定了core 0和core 1,那么可以通过这个设置避免swoole的线程或者进程绑定到这2个core，防止cpu0，1被耗光而造成的丢包
];

// 基本模式
//$mode = SWOOLE_BASE;
// 多进程模式（默认）
$mode = SWOOLE_PROCESS;

//创建Server对象，监听 127.0.0.1:9501端口
$serv = new \Swoole\Server('127.0.0.1', 9501, $mode, SWOOLE_SOCK_TCP);

$serv->set($config);

// 启动后在主进程（master）的主线程回调此函数
$serv->on('start', function ($serv) {
    // onStart回调中，仅允许echo、打印Log、修改进程名称
    echo 'on start event' . PHP_EOL;
});

$serv->on('ManagerStart', function ($serv) {
    echo 'on ManagerStart event' . PHP_EOL;
});

$serv->on('ManagerStop', function ($serv) {
    echo 'on ManagerStop event' . PHP_EOL;
});

$serv->on('WorkerStart', function ($serv, $worker_id){
    echo 'on WorkerStart event $worker_id->' .$worker_id. PHP_EOL;
});

$serv->on('WorkerStop', function ($serv, $worker_id){
    echo 'on WorkerStop event $worker_id->' .$worker_id. PHP_EOL;
});

// 仅在开启reload_async特性后有效
$serv->on('WorkerExit', function ($serv, $worker_id){
    echo 'on WorkerExit event $worker_id->' .$worker_id. PHP_EOL;
});

$serv->on('shutdown', function ($serv) {
    echo 'on shutdown event' . PHP_EOL;
});

//监听连接进入事件
$serv->on('connect', function ($serv, $fd, int $reactorId) {
echo 'on connect $reactorId->'. $reactorId . PHP_EOL;
});

//监听数据接收事件
$serv->on('receive', function ($serv, $fd, $reactorId, $data) {
    echo 'on receive $reactorId->'. $reactorId . PHP_EOL;

    //投递异步任务
    $task_id = $serv->task($data);
    echo "Dispath AsyncTask: id=$task_id\n";

    $serv->send($fd, "Server: ".$data);
});

// 接收到UDP数据包时回调此函数，发生在worker进程中
$serv->on('Packet', function ($server, string $data, array $client_info) {
    echo 'on Packet' . PHP_EOL;
});

$serv->on('PipeMessage', function ($server, int $src_worker_id, mixed $message) {
    echo 'on PipeMessage $src_worker_id->'.$src_worker_id . PHP_EOL;
});

$serv->on('WorkerError', function ($serv, int $worker_id, int $worker_pid, int $exit_code, int $signal) {
    echo 'on WorkerError' . PHP_EOL;
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd, $reactorId) {
echo "Client: Close.\n";
});

$serv->on('task', function ($serv, int $task_id, int $src_worker_id, mixed $data) {
    echo 'on task event' . PHP_EOL;
    echo "New AsyncTask[id=$task_id]".PHP_EOL;
    //返回任务执行的结果
    $serv->finish("$data -> OK");
});

$serv->on('finish', function ($serv, int $task_id, string $data) {
    echo 'on finish event' . PHP_EOL;
    echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
});

//启动服务器
$serv->start();
