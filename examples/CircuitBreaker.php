<?php
/**
 * @author: 文江义
 * @date: 13:44 2019/8/14
 */

/**
 * Class HealthStats
 * 熔断器健康状态
 */
class HealthStats
{
    /**
     * 时间窗口10个bucket，每个bucket 1秒
     */
    private const BUCKET_NUM = 10;

    /**
     * 成功率大于该值为正常
     */
    private const HEALTHY_RATE = 0.9;

    private $service = '';
    private $buckets = [];
    private $current_time = 0;

    public function __construct(string $service)
    {
        $this->service = $service;
    }

    public function success()
    {
        $this->shiftBuckets();

        $this->buckets[count($this->buckets) - 1]['success']++;
    }

    public function fail()
    {
        $this->shiftBuckets();

        $this->buckets[count($this->buckets) - 1]['fail']++;
    }

    public function isHealthy()
    {
        $this->shiftBuckets();

        $success = 0;
        $fail = 0;
        foreach ($this->buckets as $bucket) {
            $success += $bucket['success'];
            $fail += $bucket['fail'];
        }

        $total = $success + $fail;

        // 少于10个请求的样本太少，不计算成功率
        if ($total < 10) {
            return true;
        }

        return ($success * 1.0 / $total) >= self::HEALTHY_RATE;
    }

    protected function shiftBuckets()
    {
        $now = time();

        $time_diff = $now - $this->current_time;
        // 是当前时间，直接return
        if (!$time_diff) {
            return;
        }

        // 重新赋值 buckets
        if ($time_diff >= self::BUCKET_NUM) {
            $this->buckets = array_fill(0, self::BUCKET_NUM, ['success' => 0, 'fail' => 0]);
        } else {
            $this->buckets = array_merge(
                array_slice($this->buckets, $time_diff, self::BUCKET_NUM - $time_diff),
                array_fill(0, $time_diff, ['success' => 0, 'fail' => 0])
            );
        }
        $this->current_time = $now;
    }
}

/**
 * Class CircuitBreaker
 * 熔断器
 */
class CircuitBreaker
{
    /**
     * 熔断后停止所有流量5秒
     */
    private const BREAK_PERIOD = 1;

    /**
     * 完全恢复需要再花费3秒
     */
    private const RECOVER_PERIOD = 2;

    private $health_stats;
    /**
     * 1 关闭状态 熔断器的初始化状态，该状态下允许请求通过。当失败超过阀值，转入打开状态
     * 2 打开状态 熔断状态，该状态下不允许请求通过，当进入该状态经过一段时间，进入半开状态
     * 3 半开状态 在半开状态期间，允许部分请求通过，在半开期间，观察失败状态是否超过阀值。如果没有超过进入关闭状态，如果超过了进入打开状态。
     * @var int
     */
    private $status = 1;

    /**
     * 熔断的时间点
     * @var int
     */
    private $break_time = 0;

    public function __construct(HealthStats $health_stats)
    {
        $this->health_stats = $health_stats;
    }

    public function isBreak()
    {
        $now = time();
        $is_healthy = $this->health_stats->isHealthy();
        $break_last_time = $now - $this->break_time;

        $is_break = false;

        switch ($this->status) {
            case 1:
                if (!$is_healthy) {
                    $this->status = 2;
                    $this->break_time = time();
                    $is_break = true;
                    echo '触发熔断' . PHP_EOL;
                    sleep(3);
                }
                break;
            case 2:
                if ($break_last_time < self::BREAK_PERIOD || !$is_healthy) {
                    $is_break = true;
                } else {
                    $this->status = 3;
                    echo '进入恢复' . PHP_EOL;
                }
                break;
            case 3:
                if (!$is_healthy) {
                    $this->status = 2;
                    $this->break_time = time();
                    $is_break = true;
                    echo '恢复期间再次熔断' . PHP_EOL;
                    sleep(3);
                } else {
                    if ($break_last_time >= self::BREAK_PERIOD + self::RECOVER_PERIOD) {
                        $this->status = 1;
                        echo '恢复正常' . PHP_EOL;
                    } else {
                        $pass_rate = $break_last_time * 1.0 / (self::BREAK_PERIOD + self::RECOVER_PERIOD);
                        if (mt_rand() / mt_getrandmax() > $pass_rate) {
                            $is_break = true;
                        }
                    }
                }
                break;
        }
        return $is_break;
    }
}

$healthStats = new HealthStats('test_1');
$circuitBreaker = new CircuitBreaker($healthStats);

for ($i = 0; $i < 40; $i++) {
    if (in_array($i, [9 , 10, 20])) {
        $healthStats->fail();
    } else {
        $healthStats->success();
    }
    $circuitBreaker->isBreak();
    echo $i;
}

