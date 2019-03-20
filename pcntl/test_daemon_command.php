<?php
/**
 * @author: jiangyi
 * @date: 下午4:38 2019/3/18
 */

include __DIR__ . '/DaemonCommand.php';

/*$daemon=new DaemonCommand(true);
$daemon->daemonize();
$daemon->start(2);
work();*/

//具体功能的实现
function work12()
{
    file_put_contents(__DIR__ . '/test_file.txt', time() . "\n");
}

//调用方法2
$daemon = new DaemonCommand(true, 'jiangyi');
$daemon->daemonize();
//function 要运行的函数,argv运行函数的参数，runtime运行的次数
$daemon->addJobs(['callback' => 'work12', 'argv' => '', 'runtime' => 10]);
//开启2个子进程工作
$daemon->start(2);
