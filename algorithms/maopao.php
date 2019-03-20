<?php
/**
 * @author: jiangyi
 * @date: 下午5:01 2019/3/15
 */

function maoPao($arr)
{
    $len = count($arr);
    //设置一个空数组 用来接收冒出来的泡
    //该层循环控制 需要冒泡的轮数
    for ($i = 1; $i < $len; $i++) {
        //该层循环用来控制每轮 冒出一个数 需要比较的次数
        for ($k = 0; $k < $len - $i; $k++) {
            if ($arr[$k] > $arr[$k + 1]) {
                $tmp = $arr[$k + 1];
                $arr[$k + 1] = $arr[$k];
                $arr[$k] = $tmp;
            }
        }
    }
    return $arr;
}

$arr = [5,2,4,6,1,3];
var_dump(maoPao($arr));
