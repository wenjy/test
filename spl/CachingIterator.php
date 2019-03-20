<?php
/**
 * @author: jiangyi
 * @date: 下午2:06 2018/11/12
 */


$array = ['a', 'b', 'c', 'd'];

try {
    $object = new CachingIterator(new ArrayIterator($array));
    foreach ($object as $value) {
        echo $value . PHP_EOL;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
