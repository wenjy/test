<?php

/**
 * @author: 文江义
 * @date: 13:54 2019/6/3
 */
class MyCountable implements Countable
{
    private $myCount = 3;

    public function count()
    {
        return $this->myCount;
    }
}

$countable = new MyCountable();
var_dump($countable->count());
var_dump(count($countable));
