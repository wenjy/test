<?php
/**
 * @author: 文江义
 * @date: 10:16 2019/4/28
 */

// 函数一般被禁用

function run($ip)
{
    // 验证 IPV4
    if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return false;
    }
    $delay = false;

    // 默认 Linux rtt min/avg/max/mdev = 5.360/5.360/5.360/0.000 ms
    $pattern = '/(?<min>[\d|\.]+)\/(?<delay>[\d|\.]+)\/(?<max>[\d|\.]+)\/(?<mdev>[\d|\.]+)/';
    // 只 ping 一次，避免超时等等时间过长
    $command = 'ping -c 1 ';
    if (substr(PHP_OS, 0, 3) == 'WIN') {
        // Minimum = 5ms, Maximum = 5ms, Average = 5ms
        $pattern = '/Minimum = (?<min>\d+)ms, Maximum = (?<max>\d+)ms, Average = (?<delay>\d+)ms/';
        $command = 'ping -n 1 ';
    }
    $result = exec($command . $ip);

    if (preg_match($pattern, $result, $matches)) {
        !empty($matches['delay']) and $delay = $matches['delay'];
    }

    return $delay ? (int)ceil($delay) : $delay;
}

$ip = '114.114.114.114';
var_dump(run($ip));
