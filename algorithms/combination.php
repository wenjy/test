<?php
/**
 * @author: jiangyi
 * @date: 下午12:30 2019/3/26
 */

/**
 * 阶乘
 */
function factorial($n)
{
    //array_product 计算并返回数组的乘积
    //range 创建一个包含指定范围的元素的数组
    return array_product(range(1, $n));
}

/**
 * 排列数
 */
function A($n, $m)
{
    return factorial($n) / factorial($n - $m);
}

/**
 * 组合数
 */
function C($n, $m)
{
    return A($n, $m) / factorial($m);
}

/**
 * 排列结果
 */
function arrangement($a, $m)
{
    $r = [];
    $n = count($a);
    if ($m <= 0 || $m > $n) {
        return $r;
    }
    for ($i = 0; $i < $n; $i++) {
        $b = $a;
        $t = array_splice($b, $i, 1);
        if ($m == 1) {
            $r[] = $t;
        } else {
            $c = arrangement($b, $m - 1);
            foreach ($c as $v) {
                $r[] = array_merge($t, $v);
            }
        }
    }

    return $r;
}

/**
 * 组合结果
 */
function combination($a, $m)
{
    $r = [];
    $n = count($a);
    if ($m <= 0 || $m > $n) {
        return $r;
    }

    for ($i = 0; $i < $n; $i++) {
        $t = [$a[$i]];
        if ($m == 1) {
            $r[] = $t;
        } else {
            $b = array_slice($a, $i + 1);
            $c = combination($b, $m - 1);
            foreach ($c as $v) {
                $r[] = array_merge($t, $v);
            }
        }
    }
    return $r;
}

var_dump(C(5, 3));
var_dump(combination(range(1, 5), 3));
