<?php
/**
 * @author: 文江义
 * @date: 15:57 2019/4/24
 */

/**
 * @param int $a
 * @param int $b
 * @return float|int
 */
function add(int $a, int $b): int
{
    if (func_num_args() > 2) {
        return array_sum(func_get_args());
    }
    return $a + $b;
}

var_dump(add(1, 2));
var_dump(add(1, 2, 4, 5, 6));

function test(...$arg)
{
    var_dump($arg);
}

test(1,2,[3,4]);

function test1($arg)
{
    var_dump($arg);
    var_dump(func_get_args());
}

$arg = [1,2,3];
test1(...$arg);

class Test
{

}
$test = new Test();
var_dump($test->a->b ?? 123);
var_dump(!empty($test->a->b) ? $test->a->b : 123);
