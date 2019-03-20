<?php
/**
 * @author: jiangyi
 * @date: 上午9:08 2017/12/20
 */

class MyIteratorAggregate implements IteratorAggregate
{
    public $property1 = "Public property one";
    public $property2 = "Public property two";
    public $property3 = "Public property three";

    public $arr = [1, 2, 3, 4, 5, 6];

    public function __construct()
    {
        $this->property4 = "last property";
    }

    /**
     * 聚合迭代器本身不实现迭代的5个方法接口(rewind valid key current next),
     * 委托ArrayIterator实现
     *
     * @return ArrayIterator
     * @author jiangyi
     */
    public function getIterator()
    {
        //return new ArrayIterator($this);
        return new ArrayIterator($this->arr);
    }
}

$obj = new MyIteratorAggregate;

foreach ($obj as $key => $value) {
    var_dump($key, $value);
    echo "\n";
}
