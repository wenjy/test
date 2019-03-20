<?php
/**
 * @author: jiangyi
 * @date: 上午11:08 2018/11/12
 */

$array = ['a', 'b', 'c', 'd'];

$arrayObj = new ArrayObject($array);
$arrayObj->append('e');
$arrayObj->natcasesort();
echo 'count->' . $arrayObj->count() . PHP_EOL;
$arrayObj->offsetUnset(3);
if ($arrayObj->offsetExists(2)) {
    echo 'Offset Exists' . PHP_EOL;
}
$arrayObj->offsetSet(5, 'f');
echo $arrayObj->offsetGet(4) . PHP_EOL;
for ($iterator = $arrayObj->getIterator();
     $iterator->valid();
     $iterator->next()) {
    echo $iterator->key() . ' => ' . $iterator->current() . PHP_EOL;
}
