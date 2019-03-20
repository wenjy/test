<?php
/**
 * 这个迭代器允许在遍历数组和对象时删除和更新值与键。
 *
 * @author: jiangyi
 * @date: 上午11:13 2018/11/12
 */

$array = ['a', 'b', 'c', 'd'];

try {
    $object = new ArrayIterator($array);
    foreach ($object as $key => $value) {
        echo $key . ' => ' . $value . PHP_EOL;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
