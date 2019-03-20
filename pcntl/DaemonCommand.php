<?php

/**
 * @see https://blog.csdn.net/tengzhaorong/article/details/9764655
 *
 * 通过二次 pcntl_fork() 以及 posix_setsid 让主进程脱离终端
 * 通过 pcntl_signal() 忽略或者处理 SIGHUP 信号
 * 多进程程序需要通过二次 pcntl_fork() 或者 pcntl_signal() 忽略 SIGCHLD 信号防止子进程变成 Zombie 进程
 * 通过 umask() 设定文件权限掩码，防止继承文件权限而来的权限影响功能
 * 将运行进程的 STDIN/STDOUT/STDERR 重定向到 /dev/null 或者其他流上
 * @author: jiangyi
 * @date: 下午3:51 2019/3/18
 */
class DaemonCommand
{
    protected $dir = '/tmp';

    protected $pidFile = '';

    /**
     * @var bool 是否中断
     */
    protected $terminate = false;

    protected $workersCount = 0;

    protected $workersMax = 8;

    protected $isSington = false;

    protected $user;

    protected $output;

    protected $jobs = [];

    public function __construct($isSington = false, $user = 'nobody', $output = '/dev/null')
    {
        $this->isSington = $isSington;
        $this->user = $user;
        $this->output = $output;
    }

    public function checkPcntl()
    {
        // Make sure PHP has support for pcntl
        if (!function_exists('pcntl_signal')) {
            $message = 'PHP does not appear to be compiled with the PCNTL extension.  This is neccesary for daemonization';
            $this->log($message);
            throw new Exception($message);
        }
        //信号处理
        pcntl_signal(SIGTERM, [__CLASS__, 'signalHandler'], false);
        pcntl_signal(SIGINT, [__CLASS__, 'signalHandler'], false);
        pcntl_signal(SIGQUIT, [__CLASS__, 'signalHandler'], false);
    }

    public function daemonize()
    {
        global $stdin, $stdout, $stderr;
        global $argv;

        set_time_limit(0);

        if (PHP_SAPI != 'cli') {
            exit('必须运行在CLI模式下');
        }

        if ($this->isSington) {
            $this->pidFile = $this->dir . DIRECTORY_SEPARATOR . substr(basename($argv[0]), 0, -4);
            $this->checkPidFile();
        }

        // 把文件掩码清0
        umask(0);

        // 是父进程，父进程退出
        if (pcntl_fork() != 0) {
            exit();
        }
        // 设置新会话组长，脱离终端
        posix_setsid();
        // 是第一子进程，结束第一子进程
        if (pcntl_fork() != 0) {
            exit();
        }

        chdir('/'); //改变工作目录

        $this->setUser($this->user) or die('cannot change owner');

        //关闭打开的文件描述符
        fclose(STDIN);
        fclose(STDOUT);
        fclose(STDERR);

        $stdin = fopen($this->output, 'r');
        $stdout = fopen($this->output, 'a');
        $stderr = fopen($this->output, 'a');
        if ($this->isSington) {
            $this->createPidfile();
        }

    }

    protected function checkPidFile()
    {
        if (!file_exists($this->pidFile)) {
            return true;
        }
        $pid = file_get_contents($this->pidFile);
        $pid = intval($pid);
        if ($pid > 0 && posix_kill($pid, 0)) {
            $this->log('the daemon process is already started');

        } else {
            $this->log('the daemon proces end abnormally, please check pidfile ' . $this->pidFile);
        }
        exit(1);
    }

    protected function createPidFile()
    {
        if (!is_dir($this->dir)) {
            mkdir($this->dir);
        }

        $fp = fopen($this->pidFile, 'w') or die('cannot create pid file');
        fwrite($fp, posix_getpid());
        fclose($fp);
        $this->log('create pid file ' . $this->pidFile);
    }

    protected function setUser($name)
    {
        $result = false;
        if (empty($name)) {
            return true;
        }
        if ($user = posix_getpwnam($name)) {
            $uid = $user['uid'];
            $gid = $user['gid'];
            $result = posix_setuid($uid);
            posix_setgid($gid);
        }
        return $result;
    }

    protected function signalHandler($signal)
    {
        switch ($signal) {

            //用户自定义信号
            case SIGUSR1: //busy
                if ($this->workersCount < $this->workersMax) {
                    $pid = pcntl_fork();
                    if ($pid > 0) {
                        $this->workersCount++;
                    }
                }
                break;
            //子进程结束信号
            case SIGCHLD:
                while (($pid = pcntl_waitpid(-1, $status, WNOHANG)) > 0) {
                    $this->workersCount--;
                }
                break;
            //中断进程
            case SIGTERM:
            case SIGHUP:
            case SIGQUIT:
                $this->terminate = true;
                break;
            default:
                return false;
        }
        return true;
    }

    public function start($count = 1)
    {
        $this->log("daemon process is running now");
        // if worker die, minus children num
        pcntl_signal(SIGCHLD, [__CLASS__, "signalHandler"], false);

        while (true) {
            if (function_exists('pcntl_signal_dispatch')) {

                pcntl_signal_dispatch();
            }

            if ($this->terminate) {
                break;
            }
            $pid = -1;
            if ($this->workersCount < $count) {

                $pid = pcntl_fork();
            }
            if ($pid > 0) {
                $this->workersCount++;
            } elseif ($pid == 0) {
                // 这个符号表示恢复系统对信号的默认处理
                pcntl_signal(SIGTERM, SIG_DFL);
                pcntl_signal(SIGCHLD, SIG_DFL);
                if (!empty($this->jobs)) {
                    while ($this->jobs['runtime']) {
                        if (!empty($this->jobs['argv'])) {
                            call_user_func($this->jobs['callback'], $this->jobs['argv']);
                        } else {
                            call_user_func($this->jobs['callback']);
                        }
                        $this->jobs['runtime']--;
                        sleep(2);
                    }
                    exit();
                }
                return;
            } else {
                sleep(2);
            }
        }
        $this->mainQuit();
        exit(0);
    }

    protected function mainQuit()
    {
        if (file_exists($this->pidFile)) {
            unlink($this->pidFile);
            $this->log("delete pid file " . $this->pidFile);
        }
        $this->log("daemon process exit now");
        posix_kill(0, SIGKILL);
        exit(0);
    }

    public function addJobs($jobs = [])
    {

        if (!isset($jobs['argv']) || empty($jobs['argv'])) {

            $jobs['argv'] = '';

        }
        if (!isset($jobs['runtime']) || empty($jobs['runtime'])) {

            $jobs['runtime'] = 1;

        }

        if (empty($jobs['callback']) || !is_callable($jobs['callback'], true)) {

            $this->log('callback 必须可调用');
            return;
        }

        $this->jobs = $jobs;
    }

    //日志处理
    private function log($message)
    {
        printf("%s\t%d\t%d\t%s\n", date('Y-m-d H:i:s'), posix_getpid(), posix_getppid(), $message);
    }
}
