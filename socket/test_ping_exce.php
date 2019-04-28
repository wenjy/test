<?php
/**
 * @author: 文江义
 * @date: 10:16 2019/4/28
 */

// 函数一般被禁用
$res = exec('ping -w 4 118.190.95.43');
var_dump($res);
