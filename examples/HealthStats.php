<?php
/**
 * @author: 文江义
 * @date: 11:51 2019/8/14
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
    private const HEALTHY_RATE = 0.8;

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
