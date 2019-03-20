<?php
/**
 * @author: jiangyi
 * @date: 下午2:07 2018/11/12
 */
/*** the offset value ***/
$offset = 3;

/*** the limit of records to show ***/
$limit = 2;

$array = ['koala', 'kangaroo', 'wombat', 'wallaby', 'emu', 'kiwi', 'kookaburra', 'platypus'];

$it = new LimitIterator(new ArrayIterator($array), $offset, $limit);

foreach ($it as $k => $v) {
    //echo $it->getPosition() . PHP_EOL;
    echo $k .'=>'.$v . PHP_EOL;
}

$array = ['koala', 'kangaroo', 'wombat', 'wallaby', 'emu', 'kiwi', 'kookaburra', 'platypus'];

$it = new LimitIterator(new ArrayIterator($array));

try {
    $it->seek(5);
    echo $it->current();
} catch (OutOfBoundsException $e) {
    echo $e->getMessage() . PHP_EOL;
}
