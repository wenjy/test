<?php
/**
 * 分治法：将原问题分解为几个规模较小但类似的子问题，递归地求解这些子问题，
 * 然后再合并这些子问题的解来建立原问题的解
 * 快速排序，归并排序
 *
 * @author: jiangyi
 * @date: 下午9:55 2018/11/23
 */

$arr = [5, 2, 4, 7, 1, 3, 8, 6, 10, 9, 2];
function merge(&$arr, $p, $q, $r)
{
    // 两个起始点位置
    $i = $p;
    $j = $q + 1;
    // 两个起始点都不能超过各自的终点，这里可能导致其中一个起始点没循环完
    while ($i <= $q && $j <= $r) {
        if ($arr[$i] < $arr[$j]) {
            $temp[] = $arr[$i++];
        } else {
            $temp[] = $arr[$j++];
        }
    }

    // 这里把 $p - $q 未循环完的加入
    while ($i <= $q) {
        $temp[] = $arr[$i++];
    }

    // 这里把 $q + 1 - $r 未循环完的加入
    while ($j <= $r) {
        $temp[] = $arr[$j++];
    }

    // 将排好序的插入原数组
    for ($k = 0, $len = count($temp); $k < $len; $k++) {
        $arr[$p + $k] = $temp[$k];
    }
}

function mergeSort(&$arr, $p, $r)
{
    //当子序列长度为1时，不用再分组
    if ($p < $r) {
        $q = floor(($p + $r) / 2); // $arr $arr[$p - $q] $arr[$q+1 - $r]
        mergeSort($arr, $p, $q); // $arr[$p - $q]
        mergeSort($arr, $q + 1, $r); // $arr[$q+1 - $r]
        merge($arr, $p, $q, $r);
    }
}

mergeSort($arr, 0, count($arr) - 1);
var_dump($arr);

