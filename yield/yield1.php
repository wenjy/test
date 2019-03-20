<?php
/**
 * @author: jiangyi
 * @date: 下午7:39 2018/2/24
 */

include_once './Scheduler.php';
include_once './SystemCall.php';

$scheduler = new Scheduler;

$scheduler->newTask(task1());
$scheduler->newTask(task2());
$scheduler->run();

function task1()
{
    for ($i = 1; $i <= 10; ++$i) {
        echo "This is task 1 iteration $i.\n";
        yield;
    }
}

function task2()
{
    for ($i = 1; $i <= 5; ++$i) {
        echo "This is task 2 iteration $i.\n";
        yield;
    }
}

