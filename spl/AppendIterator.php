<?php
/**
 * @author: jiangyi
 * @date: 下午7:11 2017/12/20
 */

/**
 * 这个迭代器能陆续遍历几个迭代器
 *
 * Class Obj
 */
class Obj extends AppendIterator
{

}

$arrayIteratorOne = new ArrayIterator(['a', 'b', 'c']);
$arrayIteratorTwo = new ArrayIterator(['d', 'e', 'f']);

$iterator = new AppendIterator;
$iterator->append($arrayIteratorOne);
$iterator->append($arrayIteratorTwo);

foreach ($iterator as $current) {
    echo $current . PHP_EOL;
}
