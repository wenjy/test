<?php
/**
 * @author: jiangyi
 * @date: 下午7:43 2018/2/4
 */

class Class1
{
    private $class;
    public function __construct(CLassA $class, $class1a, $b = ['Class1构造函数默认参数'])
    {
        $this->class = $class;
    }
}

class Class4
{
    public function test()
    {

    }
}

$class4 = new Class4();
$class4->id = 123;
var_dump($class4);
class ClassA
{
    public function __construct(Class4 $class4)
    {
    }
}

class Class2 extends Class1
{

}

class Instance
{
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public static function of($id)
    {
        return new static($id);
    }
}

$reflection = new ReflectionClass('ClassA');

//var_dump($reflection);
$constructor = $reflection->getConstructor();
$dependencies = [];
if ($constructor !== null) {
    // 循环构造函数的参数
    foreach ($constructor->getParameters() as $param) {
        // 构造函数如果有默认值，将默认值作为依赖。即然是默认值了，就肯定是简单类型了。
        if ($param->isDefaultValueAvailable()) {
            $dependencies[] = $param->getDefaultValue();
            // 构造函数没有默认值，则为其创建一个引用。就是前面提到的 Instance 类型。
        } else {
            $c = $param->getClass();
            //var_dump($c);
            // Instance下的id为
            $dependencies[] = Instance::of($c === null ? null : $c->getName());
        }
    }
}

var_dump($dependencies);

//foreach ($dependencies as $index => $dependency) {
    var_dump($reflection->isInstantiable());
//}

list($u_sec, $sec) = explode(' ', microtime());
$vip_no =  substr(date('Ymd', $sec), 2) . substr($u_sec, 2, 4) . mt_rand(0,9);
var_dump($vip_no);

var_dump(empty($exception));
function test1($a = 1)
{

}
//$callback[0] = 'Class4';
//$callback[1] = 'test';
$callback = 'test1';
if (is_array($callback)) {
    $reflection = new \ReflectionMethod($callback[0], $callback[1]);
} else {
    // 类名称和方法名称，之间使用 :: 分隔
    $reflection = new \ReflectionFunction($callback);
}
var_dump($reflection);
var_dump($reflection->getParameters());

$call = function()
{
    return 'qq';
};

function test2(callable $callable)
{
    echo $callable();
}

test2($call);

function test3($a, $b)
{
    var_dump(func_get_args());
}

test3(1,2,3,4);

$arr = ['a' => null];
var_dump(isset($arr[  'a']));
var_dump(array_key_exists('a', $arr));
var_dump(defined('TEST'));
$dir = __DIR__;
var_dump($dir);
var_dump(dirname($dir));