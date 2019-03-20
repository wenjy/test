#!/bin/env php
<?php
/** A example denoted muti-process application in php
 * @filename fork.php
 * @touch date Wed 10 Jun 2009 10:25:51 PM CST
 * @author Laruence<laruence@baidu.com>
 * @license http://www.zend.com/license/3_0.txt   PHP License 3.0
 * @version 1.0.0
 */

/** 确保这个函数只能运行在SHELL中 */
if (substr(php_sapi_name(), 0, 3) !== 'cli') {
    die("This Programe can only be run in CLI mode");
}

/**  关闭最大执行时间限制, 在CLI模式下, 这个语句其实不必要 */
set_time_limit(0);

$pid = posix_getpid(); //取得主进程ID
$user = posix_getlogin(); //取得用户名

echo <<<EOD
USAGE: [command | expression]
input php code to execute by fork a new process
input quit to exit
 
        Shell Executor version 1.0.0 by laruence
EOD;

while (true) {

    $prompt = "\n{$user}$ ";
    $input = readline($prompt);

    // 添加一行命令行历史记录
    readline_add_history($input);
    if ($input == 'quit') {
        break;
    }
    process_execute($input . ';');
}

exit(0);

function process_execute($input)
{
    $pid = pcntl_fork(); //创建子进程
    // 父进程和子进程都会执行下面代码
    if ($pid == 0) {
        //子进程得到的$pid为0, 所以这里是子进程执行的逻辑。
        $pid = posix_getpid();
        echo "* Process {$pid} was created, and Executed:`{$input}`\n\n";
        eval($input); //解析命令
        exit;
    } elseif ($pid == -1) {
        //错误处理：创建子进程失败时返回-1.
        die('could not fork');
    } else {
        //父进程会得到子进程号，所以这里是父进程执行的逻辑
        $pid = pcntl_wait($status, WUNTRACED); //取得子进程结束状态
        if (pcntl_wifexited($status)) {
            echo "\n\n* Sub process: {$pid} exited with {$status}";
        }
    }
}
