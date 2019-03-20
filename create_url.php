<?php
/**
 * @author: jiangyi
 * @date: 下午4:45 2018/11/13
 */

foreach (glob(__DIR__.'/../DesignPatten/*.php') as $k => $v) {
    $num = $k+1;
    echo $num.'. [](https://github.com/wenjy/design_patten_php/blob/master/'.basename($v).')<br>';
}
