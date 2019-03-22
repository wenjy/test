<?php
/**
 * php代码注入测试
 *
 * @author: jiangyi
 * @date: 上午9:10 2018/3/29
 */

/**
 * eval system assert 直接执行命令
 * preg_replace php5 -e修饰符 preg_replace('/test/e',phpinfo(),'jutst test');
 * create_function 执行一个函数体
 * call_user_func call_user_func_array
 * $filter= ‘assert’;
    $value = ‘phpinfo()’;
    call_user_func($filter, $value);
 * array_map 这些都是执行一个函数
 * ob_start $sky = 'system'; ob_start($sky); echo 'ls -al'; ob_end_flush();
 * exec
 * shell_exec
 * passthru
 * escapeshellcmd
 *
 *
 * popen
 * proc_open
 * pcntl_exec
 * 反引号 反引用的本质就是在操作系统执行该命令
 *
 */
function

()
{
    $command = 'ping -n 2 '.$_GET['ip'];
    echo $command;
    @eval($command);
    @system($command);
    @assert($command);
}

testEval();