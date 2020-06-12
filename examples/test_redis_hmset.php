<?php
/**
 * @author: 文江义
 * @date: 14:47 2020/5/22
 */

$redis = new \Redis();

$redis->connect('172.18.0.12');
$redis->auth('EYkk2SGghwKWxxqw');
$redis->select(1);

$redis->hSet('test_hash_3', 2886730033, 3);
$redis->hMSet('test_hash_4', [2886730033 => 4]);
