<?php

/**
 * 插入排序
 *
 * @author: jiangyi
 * @date: 下午8:34 2018/5/18
 */
function insertionSort($arr, $sort = 'ASC')
{
    $length = count($arr);
    for ($j = 1; $j < $length; $j++) {
        $key = $arr[$j];
        // 前一位
        $i = $j - 1;
        // 把 $key 依次和前面的数比较
        // 第一次比较，如果前一位数比 $key 大，就把前一位数代替 $key ，这样前一位就空出来了
        // 后面的比较，如果再比 $key 大，则向后移一位（因为前面的数已经是顺序的了）
        // 直到遇到不比 $key 大的，或者比完了
        while ($i >= 0 && (($sort === 'ASC' && $arr[$i] > $key) || ($sort === 'DESC' && $arr[$i] < $key))) {
            $arr[$i+1] = $arr[$i];
            $i--;
        }
        // 最后把 $key 补上空位
        $arr[$i+1] = $key;
    }
    return $arr;
}

$arr = [5,2,4,6,1,3];
var_dump(insertionSort($arr, 'DESC'));
var_dump(insertionSort($arr, 'ASC'));


