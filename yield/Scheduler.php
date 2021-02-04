<?php
/**
 * @author: jiangyi
 * @date: 下午6:11 2018/2/26
 */

class Scheduler
{
    /**
     * @var int
     */
    protected $maxTaskId = 0;

    /**
     * taskId => task
     * @var array
     */
    protected $taskMap = [];

    /**
     * 任务队列
     * @var SplQueue
     */
    protected $taskQueue;

    // resourceID => [socket, tasks]
    // 承载等待的socket 及等待它们的任务的数组
    protected $waitingForRead = [];
    protected $waitingForWrite = [];

    public function __construct()
    {
        $this->taskQueue = new SplQueue();
    }

    /**
     * @param Generator $coroutine
     * @return int
     */
    public function newTask(Generator $coroutine):int
    {
        $tid = ++$this->maxTaskId;
        $task = new Task($tid, $coroutine);
        $this->taskMap[$tid] = $task;
        $this->schedule($task);
        return $tid;
    }

    /**
     * 插入队列
     * @param Task $task
     */
    public function schedule(Task $task)
    {
        $this->taskQueue->enqueue($task);
    }

    public function run()
    {
        while (!$this->taskQueue->isEmpty()) {
            // 拿出任务
            /**@var Task $task*/
            $task = $this->taskQueue->dequeue();
            // 运行
            $retval = $task->run();

            if ($retval instanceof SystemCall) {
                try {
                    $retval($task, $this);
                } catch (Exception $e) {
                    $task->setException($e);
                    $this->schedule($task);
                }
                continue;
            }

            // 已经完成，则删除此任务，否则入队
            if ($task->isFinished()) {
                unset($this->taskMap[$task->getTaskId()]);
            } else {
                $this->schedule($task);
            }
        }
    }

    /**
     * @param int $tid
     * @return bool
     */
    public function killTask(int $tid):bool
    {
        if (!isset($this->taskMap[$tid])) {
            return false;
        }

        unset($this->taskMap[$tid]);

        // This is a bit ugly and could be optimized so it does not have to walk the queue,
        // but assuming that killing tasks is rather rare I won't bother with it now
        foreach ($this->taskQueue as $i => $task) {
            if ($task->getTaskId() === $tid) {
                unset($this->taskQueue[$i]);
                break;
            }
        }

        return true;
    }

    /**
     * @param $socket
     * @param Task $task
     */
    public function waitForRead($socket, Task $task)
    {
        if (isset($this->waitingForRead[(int)$socket])) {
            $this->waitingForRead[(int)$socket][1][] = $task;
        } else {
            $this->waitingForRead[(int)$socket] = [$socket, [$task]];
        }
    }

    public function waitForWrite($socket, Task $task)
    {
        if (isset($this->waitingForWrite[(int)$socket])) {
            $this->waitingForWrite[(int)$socket][1][] = $task;
        } else {
            $this->waitingForWrite[(int)$socket] = [$socket, [$task]];
        }
    }

    // 检查 socket 是否可用, 并重新安排各自任务
    protected function ioPoll($timeout)
    {
        $rSocks = [];
        foreach ($this->waitingForRead as [$socket]) {
            $rSocks[] = $socket;
        }

        $wSocks = [];
        foreach ($this->waitingForWrite as [$socket]) {
            $wSocks[] = $socket;
        }

        $eSocks = []; // dummy

        // stream_select 函数接受承载读取、写入以及待检查的socket的数组（我们无需考虑最后一类).
        // 数组将按引用传递, 函数只会保留那些状态改变了的数组元素.
        // 我们可以遍历这些数组, 并重新安排与之相关的任务.
        if (!stream_select($rSocks, $wSocks, $eSocks, $timeout)) {
            return;
        }

        foreach ($rSocks as $socket) {
            [, $tasks] = $this->waitingForRead[(int)$socket];
            unset($this->waitingForRead[(int)$socket]);

            foreach ($tasks as $task) {
                $this->schedule($task);
            }
        }

        foreach ($wSocks as $socket) {
            [, $tasks] = $this->waitingForWrite[(int)$socket];
            unset($this->waitingForWrite[(int)$socket]);

            foreach ($tasks as $task) {
                $this->schedule($task);
            }
        }
    }

    protected function ioPollTask()
    {
        while (true) {
            if ($this->taskQueue->isEmpty()) {
                $this->ioPoll(null);
            } else {
                $this->ioPoll(0);
            }
            yield;
        }
    }
}
