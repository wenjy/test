<?php
/**
 * @author: jiangyi
 * @date: 13:17 2019-08-11
 * 二分查找
 *
 */

/**
 * @param array $data
 * @param $search
 * @return int|null 返回查询到的键名
 */
function binary_search(array $data, $search)
{
    $low = 0;
    $high = count($data) - 1;

    while ($low <= $high) {
        $mid = (int)(($low + $high) / 2);

        $guess = $data[$mid];

        if ($guess == $search) {
            return $mid;
        } elseif ($guess > $search) {
            $high = $mid - 1;
        } else {
            $low = $mid + 1;
        }
    }
    return null;
}

$array = [1, 3, 5, 6, 8, 9, 14, 15];

var_dump(binary_search($array, 0));
