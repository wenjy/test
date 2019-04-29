<?php
/**
 * @author: 文江义
 * @date: 9:11 2019/4/29
 */
go(function(){
    echo "coro 1 start\n";
    co::sleep(1);
    echo "coro 1 exit\n";
});
echo "main flag\n";
go(function(){
    echo "coro 2 start\n";
    co::sleep(1);
    echo "coro 2 exit\n";
});
echo "main end\n";
