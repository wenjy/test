<?php
/**
 * 提炼函数.
 * User: jiangyi
 * Date: 2017/10/12
 * Time: 下午7:29
 *
 * 当看见一个过长的函数或者一段需要注释才能让人理解的代码，那就将这段代码放进一个独立地函数中。
 * 根据这个函数的意图来对它命名
 */

/**
 * 无局部变量，直接复制粘贴就行
 */
function printOwing()
{
    $e = array(1,2,3);
    $outstanding = 0;

    //打印一些东西
    //echo '111';
    //echo '222';
    printBanner();

    foreach ($e as $v) {
        $outstanding += $v;
    }
    //被提炼的代码只是读取变量，并不修改
    //var_dump($outstanding);
    printDetail($outstanding);
}

function printDetail($outstanding)
{
    var_dump($outstanding);
}

function printBanner()
{
    echo '111';
    echo '222';
}

printOwing();
