<?php
/**
 * @author: 文江义
 * @date: 18:34 2020/5/6
 */

$i = 0;
do {
    echo ++$i;
} while ($i < 10);


return;
$header = 'bearer 123456';

if ($header && preg_match('/'.'bearer'.'\s*(\S+)\b/i', $header, $matches)) {
    var_dump($matches);
}
return;
/*$arr = [1,2,3,4,5,6,7,8,9];

$user = [2,3,4];

$offset = [];

while (true) {
    $data = [];
    foreach ($user as $key => $chunk) {
        if (!isset($offset[$key])) {
            $offset[$key] = 0;
        }
        if($res = array_slice($arr, $offset[$key], $chunk)) {
            $data[$key] = $res;
        }
        $offset[$key] += $chunk;
    }
    var_dump($data);
    if (empty($data)) {
        break;
    }
}
return;*/

$use_time = 60;
$days = 8;

$time = time();
$cursor = $time + 3 * 86400; // 前一次提取的时间
$start_at = $begin_at = $time + $use_time - 60; // 初始化开始时间戳
$step = 3600 * 2; // 每次查询的时间间隔

if ($cursor > $begin_at) {
    $begin_at = $cursor;
}

$stop_at = strtotime('today') + (86400 * $days);
$ips = [];
$time = [];

$fun = function ($begin_at, $stop_at, &$time) {
    $step = 3600 * 2; // 每次查询的时间间隔
    $end_at = $begin_at + $step; // 初始查询条件结束时间戳
    $normalize_at_flag = false; // 用于第一次跨天时，$begin_at从0时开始
    while($begin_at < $stop_at) {
        $time[] = date('Y-m-d H:i:s', $begin_at) . ' ' . date('Y-m-d H:i:s', $end_at);

        // 第二天从0点开始
        if (!$normalize_at_flag && date('Y-m-d', $begin_at) != ($end_date = date('Y-m-d', $end_at))) {
            $begin_at = strtotime($end_date);
            $end_at = $begin_at + $step;
            $normalize_at_flag = true;
        } else {
            $begin_at = $end_at + 1;
            $end_at += $step;
        }
    }
};

$fun($begin_at, $stop_at, $time);

if (empty($ips)) {
    $begin_at = $start_at;
    $stop_at = $cursor;
    $fun($begin_at, $stop_at, $time);
}
var_dump($time);

return;
$r_work = 'D:\r-test';

$r_script = 'D:\R-4.0.0\bin\Rscript.exe';

echo strtotime('today') - 7 * 86400;

$arr1 = ['a' => 1];
$arr2 = ['b' => 2];

$arr1 += $arr2;

var_dump($arr1);
return;

//exec($r_script . ' ' . $r_work . DIRECTORY_SEPARATOR . 'test_ts.r', $out, $res);
//var_dump($out, $res);

//$arr = [12,21,33,4,5,63,7,18,91,33,4,44,37,6,7,83,4,2,76,8,72,9,18,6,32,5,16,3,12,3,44,8,69,23,44,35,66,31,76];
//$arr = [1,1,1,1,1,3,4,5,3,3,3,3,4,4,4,4,4,5,6,23,34,56,23,34,24,25,36,27,22,21,123];
$arr = [2];
$count = array_count_values($arr);
var_dump(array_search(max($count), $count));

var_dump(ceil(array_sum($arr) / count($arr)));

$res = [];
for ($i = 0; $i < count($arr); $i++) {
    $v = $arr[$i];
    if (!isset($res[$v])) {
        $res[$v] = 0;
        for ($j = 0; $j < count($arr); $j++) {
            $res[$v] += abs($v - $arr[$j]);
        }
    }
}
//var_dump($res);
var_dump(max(array_keys($res, min($res))));


$time_list = [];
date_default_timezone_set('PRC');

$t = [
    ['start' => 1586880000, 'end' => 1586931676], // 5-4 1:20~ 5-5 2:30
    ['start' => 1586935852, 'end' => 1587365417], // 5-7 22:30~ 5-7 23:20
    ['start' => 1587371204, 'end' => 1587571199], // 5-7 22:30~ 5-7 23:20
];

foreach ($t as $item) {
    $time_list = array_merge_recursive($time_list, cu($item['start'], $item['end']));
}

//var_dump(array_fill(0, 24, 86400));

/**
 * @param $start
 * @param $end
 * @return array
 */
function cu($start, $end)
{
    $res = [];
    $time = $start;

    while ($time < $end) {
        $h = date('H', $time);
        $res["h{$h}"][] = $end - $time;
        $time = strtotime('+1 hours', $time);
    }

    return $res;
}

function pam(array $data): int
{
    // 保存已经计算过的值和距离
    $calculated = [];
    $length = count($data);
    for ($i = 0; $i < $length; $i++) {
        $v = $data[$i];
        if (!isset($calculated[$v])) {
            $calculated[$v] = 0;
            for ($j = 0; $j < $length; $j++) {
                $calculated[$v] += abs($v - $data[$j]);
            }
        }
    }

    // 寻找总距离最小的，如果有多值则取最大的那个
    return max(array_keys($calculated, min($calculated)));
}

//var_dump($time_list);

$list = [];
foreach ($time_list as $h => $data) {
    $list[$h] = pam($data);
}

$str = '226217:222617:219017:215417:211817:208217:204617:201017:197417:193817:190217:186617:183017:179417:175817:172217:199995:196395:192795:189195:185595:181995:178395:174795';
var_dump($list);
var_dump(1587571200 - 7 * 86400);

var_dump($str == implode(':', $list));


