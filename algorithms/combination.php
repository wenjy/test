<?php
/**
 * @author: jiangyi
 * @date: 下午12:30 2019/3/26
 */

/**
 * 阶乘
 * @param int $n
 * @return int
 */
function factorial(int $n)
{
    //array_product 计算并返回数组的乘积
    //range 创建一个包含指定范围的元素的数组
    return array_product(range(1, $n));
}

/**
 * 排列数
 * @param int $n
 * @param int $m
 * @return int
 */
function A(int $n, int $m)
{
    return factorial($n) / factorial($n - $m);
}

/**
 * 组合数
 * @param int $n
 * @param int $m
 * @return int
 */
function C($n, $m)
{
    return A($n, $m) / factorial($m);
}

/**
 * 排列结果
 * @param array $a 排列的数组
 * @param int $m 排列的个数
 * @return array
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
 * @param array $a 组合的数组
 * @param int $m 组合的个数
 * @return array
 */
function combination(array $a, int $m)
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
var_dump(combination(range(1, 3), 2));
var_dump(arrangement(range(1, 3), 2));
