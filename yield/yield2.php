<?php
/**
 * @author: jiangyi
 * @date: 下午10:27 2019/3/13
 */

include_once './Scheduler.php';
include_once './SystemCall.php';

$scheduler = new Scheduler;

function getTaskId()
{
    return new SystemCall(function (Task $task, Scheduler $scheduler) {
        $task->setSendValue($task->getTaskId());
        $scheduler->schedule($task);
    });
}

function taskMax($max) {
    $tid = (yield getTaskId()); // <-- here's the syscall!
    for ($i = 1; $i <= $max; ++$i) {
        echo "This is task $tid iteration $i.\n";
        yield;
    }
}

$scheduler->newTask(taskMax(10));
$scheduler->newTask(taskMax(5));
$scheduler->run();
