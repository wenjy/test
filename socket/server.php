<?php

/**
 * Interface EventInterface
 * @see https://github.com/walkor/Workerman
 */
interface EventInterface
{
    /**
     * Read event.
     *
     * @var int
     */
    const EV_READ = 1;

    /**
     * Write event.
     *
     * @var int
     */
    const EV_WRITE = 2;

    /**
     * Except event
     *
     * @var int
     */
    const EV_EXCEPT = 3;

    /**
     * Signal event.
     *
     * @var int
     */
    const EV_SIGNAL = 4;

    /**
     * Timer event.
     *
     * @var int
     */
    const EV_TIMER = 8;

    /**
     * Timer once event.
     *
     * @var int
     */
    const EV_TIMER_ONCE = 16;

    /**
     * Add event listener to event loop.
     *
     * @param mixed    $fd
     * @param int      $flag
     * @param callable $func
     * @param mixed    $args
     * @return bool
     */
    public function add($fd, $flag, $func, $args = null);

    /**
     * Remove event listener from event loop.
     *
     * @param mixed $fd
     * @param int   $flag
     * @return bool
     */
    public function del($fd, $flag);

    /**
     * Remove all timers.
     *
     * @return void
     */
    public function clearAllTimer();

    /**
     * Main loop.
     *
     * @return void
     */
    public function loop();

    /**
     * Destroy loop.
     *
     * @return mixed
     */
    public function destroy();

    /**
     * Get Timer count.
     *
     * @return mixed
     */
    public function getTimerCount();
}

/**
 * @see https://github.com/walkor/Workerman
 */
class MyEvent implements EventInterface
{
    /**
     * Event base.
     * @var object
     */
    protected $_eventBase = null;

    /**
     * All listeners for read/write event.
     * @var array
     */
    protected $_allEvents = array();

    /**
     * Event listeners of signal.
     * @var array
     */
    protected $_eventSignal = array();

    /**
     * All timer event listeners.
     * [func, args, event, flag, time_interval]
     * @var array
     */
    protected $_eventTimer = array();

    /**
     * Timer id.
     * @var int
     */
    protected static $_timerId = 1;

    /**
     * construct
     * @return void
     */
    public function __construct()
    {
        if (\class_exists('\\\\EventBase', false)) {
            $class_name = '\\\\EventBase';
        } else {
            $class_name = '\EventBase';
        }
        $this->_eventBase = new $class_name();
    }

    /**
     * @see EventInterface::add()
     */
    public function add($fd, $flag, $func, $args=array())
    {
        if (\class_exists('\\\\Event', false)) {
            $class_name = '\\\\Event';
        } else {
            $class_name = '\Event';
        }
        switch ($flag) {
            case self::EV_SIGNAL:

                $fd_key = (int)$fd;
                $event = $class_name::signal($this->_eventBase, $fd, $func);
                if (!$event||!$event->add()) {
                    return false;
                }
                $this->_eventSignal[$fd_key] = $event;
                return true;

            case self::EV_TIMER:
            case self::EV_TIMER_ONCE:

                $param = array($func, (array)$args, $flag, $fd, self::$_timerId);
                $event = new $class_name($this->_eventBase, -1, $class_name::TIMEOUT|$class_name::PERSIST, array($this, "timerCallback"), $param);
                if (!$event||!$event->addTimer($fd)) {
                    return false;
                }
                $this->_eventTimer[self::$_timerId] = $event;
                return self::$_timerId++;

            default :
                $fd_key = (int)$fd;
                $real_flag = $flag === self::EV_READ ? $class_name::READ | $class_name::PERSIST : $class_name::WRITE | $class_name::PERSIST;
                $event = new $class_name($this->_eventBase, $fd, $real_flag, $func, $fd);
                if (!$event||!$event->add()) {
                    return false;
                }
                $this->_allEvents[$fd_key][$flag] = $event;
                return true;
        }
    }

    /**
     * 删除事件
     */
    public function del($fd, $flag)
    {
        switch ($flag) {

            case self::EV_READ:
            case self::EV_WRITE:

                $fd_key = (int)$fd;
                if (isset($this->_allEvents[$fd_key][$flag])) {
                    $this->_allEvents[$fd_key][$flag]->del();
                    unset($this->_allEvents[$fd_key][$flag]);
                }
                if (empty($this->_allEvents[$fd_key])) {
                    unset($this->_allEvents[$fd_key]);
                }
                break;

            case  self::EV_SIGNAL:
                $fd_key = (int)$fd;
                if (isset($this->_eventSignal[$fd_key])) {
                    $this->_eventSignal[$fd_key]->del();
                    unset($this->_eventSignal[$fd_key]);
                }
                break;

            case self::EV_TIMER:
            case self::EV_TIMER_ONCE:
                if (isset($this->_eventTimer[$fd])) {
                    $this->_eventTimer[$fd]->del();
                    unset($this->_eventTimer[$fd]);
                }
                break;
        }
        return true;
    }

    /**
     * Timer callback.
     * @param null $fd
     * @param int $what
     * @param array $param
     */
    public function timerCallback($fd, $what, $param)
    {
        $timer_id = $param[4];

        if ($param[2] === self::EV_TIMER_ONCE) {
            $this->_eventTimer[$timer_id]->del();
            unset($this->_eventTimer[$timer_id]);
        }

        try {
            \call_user_func_array($param[0], $param[1]);
        } catch (\Exception $e) {
            exit(250);
        } catch (\Error $e) {
            exit(250);
        }
    }

    /**
     * @return void
     */
    public function clearAllTimer()
    {
        foreach ($this->_eventTimer as $event) {
            $event->del();
        }
        $this->_eventTimer = array();
    }


    /**
     * @see EventInterface::loop()
     */
    public function loop()
    {
        $this->_eventBase->loop();
    }

    /**
     * Destroy loop.
     *
     * @return void
     */
    public function destroy()
    {
        foreach ($this->_eventSignal as $event) {
            $event->del();
        }
    }

    /**
     * Get timer count.
     *
     * @return integer
     */
    public function getTimerCount()
    {
        return \count($this->_eventTimer);
    }
}

class TcpServer
{
    protected static $event;

    protected $address;

    protected $port;

    protected $server_socket;

    protected $accept_timeout = 1;
    protected $recv_timeout = 1;
    protected $send_timeout = 1;

    public function __construct(string $address, int $port)
    {
        self::$event = new MyEvent();
        $this->address = $address;
        $this->port = $port;
    }

    protected function listen()
    {
        if (!$this->server_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) {
            exit(socket_strerror(socket_last_error()));
        }

        if(!socket_bind($this->server_socket, '127.0.0.1', 9005))
        {
            exit(socket_strerror(socket_last_error()));
        }

        if(!socket_listen($this->server_socket))
        {
            exit(socket_strerror(socket_last_error()));
        }

        socket_set_option($this->server_socket, SOL_SOCKET, SO_KEEPALIVE, 1);
        socket_set_option($this->server_socket, SOL_SOCKET, SO_RCVTIMEO, ['sec' => $this->accept_timeout, 'usec' => 0]);
        socket_set_option($this->server_socket, SOL_TCP, TCP_NODELAY, 1);

        socket_set_nonblock($this->server_socket);
    }

    protected function start()
    {
        self::$event->add($this->server_socket, EventInterface::EV_READ, function ($server_socket) {
            $client_socket = socket_accept($server_socket);
            if (!$client_socket) {
                return;
            }

            socket_set_option($client_socket, SOL_SOCKET, SO_RCVTIMEO, ['sec' => $this->recv_timeout, 'usec' => 0]);
            socket_set_option($client_socket, SOL_SOCKET, SO_SNDTIMEO, ['sec' => $this->send_timeout, 'usec' => 0]);
            socket_set_nonblock($client_socket); //设置非阻塞模式
            socket_getpeername($client_socket, $remote_address);

            $write_buffer = '';
            self::$event->add($client_socket, EventInterface::EV_READ, function () use ($client_socket, $remote_address, &$write_buffer){
                $buf = socket_read($client_socket, 1024);
                if ($buf === '') {
                    return;
                } elseif ($buf === false) {
                    if (($errcode = socket_last_error()) !== SOCKET_EAGAIN) {
                        return;
                    }
                } else {
                    $date = date('Y-m-d H:i:s');
                    $body = "<h1>ClientAddress:{$remote_address}</h1>";
                    $body .= "<h1>ClientData:{$buf}</h1>";
                    $body .= "<h1>Time:{$date}</h1>";
                    $len = strlen($body);
                    $http_res = <<<EOF
HTTP/1.1 200
Server:Test
Content-Type:text/html;charset=utf8
Content-Length:$len

$body
EOF;
                    if ($write_buffer === '') {
                        $write_length = socket_write($client_socket, $http_res);

                        if ($write_length === strlen($buf)) {
                            return true;
                        }

                        /**
                         * 未全部写入完成将剩余部分缓存，加入事件等待可写时写入
                         */
                        if ($write_length > 0) {
                            $write_buffer = substr($buf, $write_length);
                        } else {
                            if (!is_resource($client_socket)) {
                                //发送失败，连接关闭
                                $this->destroy();
                                return false;
                            }
                            $write_buffer = $buf;
                        }
                        self::$event->add($client_socket, EventInterface::EV_WRITE, \Closure::fromCallable([$this, 'baseWrite']));
                    } else {
                        $this->write_buffer .= $buf;
                    }
                }
            });
        });
    }
}
