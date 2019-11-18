<?php
/**
 * @author: 文江义
 * @date: 14:47 2019/6/3
 */

$str = "first=value&arr[]=foo+bar&arr[]=baz";

// 推荐用法
parse_str($str, $output);
var_dump($output['first'], $output['arr'][0], $output['arr'][1]);
