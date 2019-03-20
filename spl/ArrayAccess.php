<?php
/**
 * 提供像访问数组一样访问对象的能力的接口。
 *
 * @author: jiangyi
 * @date: 上午9:21 2017/12/20
 */

class MyArrayAccess implements ArrayAccess, IteratorAggregate
{
    private $container = [];
    public $title;
    public $author;
    public $category;

    public function __construct($title, $author, $category)
    {
        $this->container = [
            "one"   => 1,
            "two"   => 2,
            "three" => 3,
        ];
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
    }

    /**
     * 设置一个偏移位置的值
     * @param mixed $offset
     * @param mixed $value
     * @author jiangyi
     */
    public function offsetSet($offset, $value)
    {
        $this->{$offset} = $value;
    }

    /**
     * 检查一个偏移位置是否存在
     * @param mixed $offset
     * @return bool
     * @author jiangyi
     */
    public function offsetExists($offset)
    {
        return isset($this->{$offset});
    }

    /**
     * 复位一个偏移位置的值
     * @param mixed $offset
     * @author jiangyi
     */
    public function offsetUnset($offset)
    {
        unset($this->{$offset});
    }

    /**
     * 获取一个偏移位置的值
     * @param mixed $offset
     * @return mixed|null
     * @author jiangyi
     */
    public function offsetGet($offset)
    {
        return isset($this->{$offset}) ? $this->{$offset} : null;
    }

    function getIterator()
    {
        return new ArrayIterator($this);
    }
}

$obj = new MyArrayAccess('a', 'wen', 'new');

var_dump(isset($obj['title']));
var_dump($obj["title"]);
unset($obj["title"]);
var_dump(isset($obj["title"]));
$obj["title"] = "A value";
var_dump($obj["title"]);
$obj['a'] = 'Append 1';
$obj['b'] = 'Append 2';
$obj['c'] = 'Append 3';

foreach ($obj as $field => $value) {
    echo "$field=>$value\n";
}
