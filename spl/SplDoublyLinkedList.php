<?php

/**
 * 双向链表
 * @author: jiangyi
 * @date: 上午10:12 2019/3/6
 */

$dlist = new SplDoublyLinkedList();

// 末端压入
$dlist->push('hiramariam');
$dlist->push('maaz');
$dlist->push('zafar');

// 首端压入
$dlist->unshift(1);
$dlist->unshift(2);
$dlist->unshift(3);

/* the list now contains
3
2
1
hiramariam
maaz
zafar
*/

echo $dlist->pop() . PHP_EOL; // zafar
echo $dlist->shift() . PHP_EOL; // 3

$dlist->add(3, 2.24);

for ($dlist->rewind(); $dlist->valid(); $dlist->next()) {

    echo $dlist->current() . PHP_EOL;
}


$list = new SplDoublyLinkedList();
$list->push('a');
$list->push('b');
$list->push('c');

echo 'FIFO (First In First Out) :' . PHP_EOL;
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
for ($list->rewind(); $list->valid(); $list->next()) {
    echo $list->current() . PHP_EOL;
}
echo "LIFO (Last In First Out) :" . PHP_EOL;
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);
for ($list->rewind(); $list->valid(); $list->next()) {
    echo $list->current() . PHP_EOL;
}

echo 'test While:' . PHP_EOL;
$splDoubleLinkedList = new SplDoublyLinkedList();
$splDoubleLinkedList->push('a');
$splDoubleLinkedList->push('3');
$splDoubleLinkedList->push('v');
//First of all, we need rewind list
$splDoubleLinkedList->rewind();
//Use while, check if the list has valid node
while ($splDoubleLinkedList->valid()) {
    //Print current node's value
    echo $splDoubleLinkedList->current() . PHP_EOL;
    //Turn the cursor to next node
    $splDoubleLinkedList->next();
}


