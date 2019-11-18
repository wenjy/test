<?php
/**
 * @author: 文江义
 * @date: 13:42 2019/8/20
 */

$action = $argv[1];

interface ServiceHandle
{
    public function handle();
}
class Test1 implements ServiceHandle
{
    public function handle()
    {
        echo 123;
    }
}

$services = [
    'test1' => Test1::class,
];


class ServiceProcessor
{
    protected $services = [];
    public function registerProcessor($service_name, ServiceHandle $service_class)
    {
        $this->services[$service_name] = $service_class;
    }

    public function process()
    {

    }
}

/**
 * 多进程处理RPC服务
 * @package App\SoaServer
 */
class MultiProgressServer
{
    /**
     * 运行配置
     * @var array
     */
    private static $config;

    /**
     * 子进程集合
     * @var array
     */
    private static $children = [];

    /**
     * 子进程工作对象
     * @var Worker
     */
    private static $child_worker = null;

    /**
     * 停止信号
     * @var bool
     */
    private static $terminate = false;

    /**
     * 主进程pid
     * @var int
     */
    private static $master_pid = 0;

    /**
     * MultiProgressServer constructor.
     * @param array $config 运行配置
     * @throws \Exception
     */
    public function __construct(array $config)
    {
        if (!isset($config['host']) || !isset($config['port'])) {
            throw new \Exception('Missing host and port configuration');
        }

        self::$config = $config;
    }

    /**
     * 运行服务器
     * @param ServiceProcessor $processor 处理服务
     * @throws \Exception
     */
    public function run(ServiceProcessor $processor)
    {
        if ($this->checkRuning()) {
            throw new \Exception('server already running');
        }

        if (isset(self::$config['daemon']) && self::$config['daemon']) {
            $this->daemon();
        }

        if (!isset(self::$config['worker_count'])) {
            self::$config['worker_count'] = 5;
        }

        /**
         * 设置进程标识，方便检查工作进程
         */
        cli_set_process_title('master server');

        /**
         * 启动工作进程达到设定数量
         */
        while (count(self::$children) < self::$config['worker_count']) {
            $this->startWorker($processor);
        }

        while (true) {

            $status = 0;
            $pid = pcntl_wait($status, WUNTRACED);

            if ($pid > 0) {
                if (isset(self::$children[$pid])) {
                    unset(self::$children[$pid]);
                }

                //如果服务器未停止状态，启动新进程处理
                if (self::$terminate === false) {
                    $this->startWorker($processor);
                }
            }

            if (self::$terminate && count(self::$children) == 0) {
                self::deletePidFile();
                exit(0);
            }
        }
    }

    /**
     * 停止服务器
     * @throws \Exception
     */
    public function stop()
    {
        if (!$this->checkRuning()) {
            throw new \Exception('server no run');
        }

        posix_kill(self::$master_pid, SIGTERM);

        $start_time = time();

        while (true) {
            if (posix_kill(self::$master_pid, 0)) {

                if (time() - $start_time > 5) {
                    throw new \Exception('server stop fail');
                }

                sleep(1);
                continue;
            }

            break;
        }
    }

    /**
     * 守护进程方式运行
     * @throws \Exception
     */
    protected function daemon()
    {
        umask(0);
        $pid = pcntl_fork();
        if (-1 === $pid) {
            throw new \Exception('fork fail');
        } elseif ($pid > 0) {
            exit(0);
        }
        if (-1 === posix_setsid()) {
            throw new \Exception("setsid fail");
        }
        $pid = pcntl_fork();
        if (-1 === $pid) {
            throw new \Exception("fork fail");
        } elseif (0 !== $pid) {
            exit(0);
        }

        self::$master_pid = posix_getpid();
        $this->registerSignalHandler();
        self::createPidFile();
    }

    /**
     * 启动工作进程
     * @param ServiceProcessor $processor 处理服务对象
     */
    protected function startWorker(ServiceProcessor $processor)
    {
        $child_pid = pcntl_fork();

        if ($child_pid == -1) {

        } elseif ($child_pid == 0) {
            /**
             * 设置进程标识，方便检查工作进程
             */
            cli_set_process_title('worker server');

            self::$child_worker = new Worker($processor, self::$config);
            self::$child_worker->setUserAndGroup(); //设置运行用户与用户组
            self::$child_worker->handle();

            exit(0);
        } else {
            self::$children[$child_pid] = [
                'start_time' => time(),
            ];
        }
    }

    /**
     * 注册信号控制器
     */
    private function registerSignalHandler()
    {
        pcntl_async_signals(true);  //启用异步信号处理
        pcntl_signal(SIGTERM, [$this, 'processSignalHandler'], false);   //注册一个信号处理器
        pcntl_signal(SIGHUP, [$this, 'processSignalHandler'], false);   //注册一个信号处理器
        pcntl_signal(SIGINT, [$this, 'processSignalHandler'], false);   //注册一个信号处理器
        pcntl_signal(SIGQUIT, [$this, 'processSignalHandler'], false);   //注册一个信号处理器
    }

    /**
     * 处理进程信号处理回调
     * @param int $signal 信号值
     */
    private function processSignalHandler(int $signal)
    {
        switch ($signal) {
            //进程中断信号
            case SIGTERM:
            case SIGHUP:
            case SIGINT:
            case SIGQUIT:
                //主进程
                self::$terminate = true;
                foreach (self::$children as $pid => $children) {
                    posix_kill($pid, SIGINT);
                }
                break;
        }
    }

    /**
     * 检测运行状态
     * @return bool
     */
    private function checkRuning()
    {
        self::$master_pid = is_file(self::$config['pid_file']) ? file_get_contents(self::$config['pid_file']) : 0;

        if (self::$master_pid && posix_kill(self::$master_pid, 0) && posix_getpid() != self::$master_pid) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 创建运行主进程的pid文件
     * @throws \Exception
     */
    private static function createPidFile()
    {
        if (!isset(self::$config['pid_file'])) {
            throw new \Exception('Not set pid file path');
        }

        if (file_exists(self::$config['pid_file'])) {
            throw new \Exception('pid file already exists');
        }
        file_put_contents(self::$config['pid_file'], self::$master_pid);
    }

    /**
     * 删除pid文件
     */
    private static function deletePidFile()
    {
        if (isset(self::$config['pid_file']) && file_exists(self::$config['pid_file'])) {
            unlink(self::$config['pid_file']);
        }
    }
}

class Worker
{

    /**
     * 服务处理器
     * @var ServiceProcessor
     */
    private $processor;

    /**
     * 运行配置
     * @var array
     */
    private $config;

    /**
     * Worker constructor.
     * @param ServiceProcessor $processor
     * @param array $config
     */
    public function __construct(ServiceProcessor $processor, array $config)
    {
        $this->processor = $processor;
        $this->config = $config;
    }

    /**
     * 处理任务
     */
    public function handle()
    {
        $this->reinstallSignal();   //重新注册信号处理

        try {

        } catch (Exception $e) {

        }
    }

    /**
     * 设置进程的用户与用户组
     */
    public function setUserAndGroup()
    {
        //获取用户信息
        $user_info = posix_getpwnam($this->config['user']);
        if (!$user_info) {
            return;
        }
        $uid = $user_info['uid'];

        //获取用户组信息
        $group_info = posix_getgrnam($this->config['group']);
        if (!$group_info) {
            return;
        }
        $gid = $group_info['gid'];
        //设置用户与用户组
        if ($uid != posix_getuid() || $gid != posix_getgid()) {
            if (!posix_setgid($gid) || !posix_initgroups($user_info['name'], $gid) || !posix_setuid($uid)) {

            }
        }
    }

    /**
     * 停止进程
     */
    public function stop()
    {
        exit(0);
    }

    /**
     * 重新注册事件监听器
     */
    protected function reinstallSignal()
    {
        //恢复子进程信号处理的为系统默认
        pcntl_signal(SIGTERM, [$this, 'signalHandler'], false);
        pcntl_signal(SIGINT, [$this, 'signalHandler'], false);
        pcntl_signal(SIGHUP, [$this, 'signalHandler'], false);
        pcntl_signal(SIGQUIT, [$this, 'signalHandler'], false);
    }

    /**
     * 系统信号处理
     * @param int $signal 信号值
     */
    protected function signalHandler(int $signal)
    {
        switch ($signal) {
            //进程中断信号
            case SIGTERM:
            case SIGHUP:
            case SIGINT:
            case SIGQUIT:
                $this->stop();
                break;
        }
    }
}

$config = [
    'user' => 'www',
    'group' => 'www',
];
try {
    $server = new MultiProgressServer($config);
    switch ($action) {
        case 'start':
            $processor = new ServiceProcessor();
            foreach ($services as $service_name => $service) {
                $processor->registerProcessor($service_name, $service);
            }
            break;
        case 'stop':
            break;
        default:
            ;
    }
}catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
