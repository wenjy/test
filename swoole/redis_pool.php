<?php
/**
 * @author: 文江义
 * @date: 14:04 2019/4/29
 *
 * @see https://github.com/swoole/swoole-src/issues/2035
 */

class RedisPool
{
    /**
     * @var \Swoole\Coroutine\Channel
     */
    protected $pool;

    /**
     * RedisPool constructor.
     * @param int $size 连接池的尺寸
     */
    public function __construct($size = 2)
    {
        $this->pool = new Swoole\Coroutine\Channel($size);
        for ($i = 0; $i < $size; $i++)
        {
            $redis = new Swoole\Coroutine\Redis();
            $res = $redis->connect('127.0.0.1', 6379);
            if ($res == false)
            {
                throw new RuntimeException("failed to connect redis server.");
            }
            else
            {
                $this->put($redis);
            }
        }
    }

    public function put($redis)
    {
        $this->pool->push($redis);
    }

    public function get()
    {
        return $this->pool->pop();
    }

    public function destruct()
    {
        $this->pool = null;
    }
}
