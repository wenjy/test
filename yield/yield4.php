<?php
/**
 * @author: jiangyi
 * @date: 下午10:33 2019/3/13
 */

include_once __DIR__ . '/Task.php';
include_once __DIR__ . '/Scheduler.php';
include_once __DIR__ . '/SystemCall.php';
include_once __DIR__ . '/CoroutineReturnValue.php';
include_once __DIR__ . '/CoSocket.php';

$scheduler = new Scheduler;

/**
 * @param Generator $coroutine
 * @return SystemCall
 */
function newTask(Generator $coroutine): SystemCall
{
    return new SystemCall(
        function (Task $task, Scheduler $scheduler) use ($coroutine) {
            $task->setSendValue($scheduler->newTask($coroutine));
            $scheduler->schedule($task);
        }
    );
}

/**
 * @param $port
 * @return Generator
 * @throws Exception
 */
function server($port): Generator
{
    echo "Starting server at port $port...\n";

    $socket = stream_socket_server("tcp://localhost:$port", $errNo, $errStr);
    if (!$socket) {
        throw new Exception($errStr, $errNo);
    }

    stream_set_blocking($socket, 0);

    $socket = new CoSocket($socket);
    while (true) {
        yield newTask(
            handleClient(yield $socket->accept())
        );
    }
}

/**
 * @param $socket
 * @return Generator
 */
function handleClient($socket): Generator
{
    /* @var CoSocket $socket */
    $data = (yield $socket->read(8192));

    $msg = "Received following request:\n\n$data";
    $msgLength = strlen($msg);

    $response = <<<RES
HTTP/1.1 200 OK\r
Content-Type: text/plain\r
Content-Length: $msgLength\r
Connection: close\r
\r
$msg
RES;

    yield $socket->write($response);
    yield $socket->close();
}

$scheduler->newTask(server(8005));
$scheduler->run();
