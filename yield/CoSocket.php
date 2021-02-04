<?php

/**
 * @author: jiangyi
 * @date: 上午10:44 2019/3/14
 */
class CoSocket
{
    protected $socket;

    public function __construct($socket)
    {
        $this->socket = $socket;
    }

    /**
     * @return Generator
     */
    public function accept(): Generator
    {
        yield waitForRead($this->socket);
        yield retval(new CoSocket(stream_socket_accept($this->socket, 0)));
    }

    /**
     * @param int $size
     * @return Generator
     */
    public function read(int $size): Generator
    {
        yield waitForRead($this->socket);
        yield retval(fread($this->socket, $size));
    }

    /**
     * @param string $string
     * @return Generator
     */
    public function write(string $string): Generator
    {
        yield waitForWrite($this->socket);
        fwrite($this->socket, $string);
    }

    public function close()
    {
        @fclose($this->socket);
    }
}

/**
 * @param $socket
 * @return SystemCall
 */
function waitForRead($socket): SystemCall
{
    return new SystemCall(
        function (Task $task, Scheduler $scheduler) use ($socket) {
            $scheduler->waitForRead($socket, $task);
        }
    );
}

/**
 * @param $socket
 * @return SystemCall
 */
function waitForWrite($socket): SystemCall
{
    return new SystemCall(
        function (Task $task, Scheduler $scheduler) use ($socket) {
            $scheduler->waitForWrite($socket, $task);
        }
    );
}
