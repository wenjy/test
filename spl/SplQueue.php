<?php
/**
 * SplQueue 类通过使用一个双向链表来提供队列的主要功能。
 * @author: jiangyi
 * @date: 上午10:42 2019/3/6
 */

$queue = new SplQueue();
$queue->enqueue('A');
$queue->enqueue('B');
$queue->enqueue('C');

$queue->rewind();
while($queue->valid()){
    echo $queue->current(),"\n";
    $queue->next();
}
echo $queue->dequeue(); //remove first one
