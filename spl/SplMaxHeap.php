<?php
/**
 * @author: jiangyi
 * @date: 上午11:11 2019/3/6
 */

class MySimpleHeap extends SplMaxHeap
{

}

$obj = new MySimpleHeap();
$obj->insert(4);
$obj->insert(8);
$obj->insert(1);
$obj->insert(0);

foreach ($obj as $number) {
    echo $number . PHP_EOL;
}
