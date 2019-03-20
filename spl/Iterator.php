<?php
/**
 * @author: jiangyi
 * @date: 上午8:53 2017/12/20
 */

class MyIterator implements Iterator
{
    private $array = [];

    private $valid = false;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * 返回到迭代器的第一个元素
     * @author jiangyi
     */
    function rewind()
    {
        $this->valid = (false !== reset($this->array));
    }

    /**
     * 返回当前元素
     * @return mixed
     * @author jiangyi
     */
    function current()
    {
        return current($this->array);
    }

    /**
     * 返回当前元素的键
     * @return int
     * @author jiangyi
     */
    function key()
    {
        return key($this->array);
    }

    /**
     * 向前移动到下一个元素
     * @author jiangyi
     */
    function next()
    {
        $this->valid = (false !== next($this->array));
    }

    /**
     * 检查当前位置是否有效
     * @return bool
     * @author jiangyi
     */
    function valid()
    {
        return $this->valid;
    }
}

$array = [
    'a' => "firstelement",
    "secondelement",
    "lastelement",
];
$it = new MyIterator($array);

foreach ($it as $key => $value) {
    echo "{$key}=>{$value}\n";
}

$it->rewind();
while ($it->valid()) {
    echo "{$it->key()}=>{$it->current()}\n";
    $it->next();
}
