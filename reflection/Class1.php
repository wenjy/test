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

class ClassA
{
    public function __construct(Class4 $class4)
    {
    }
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

$reflection = new ReflectionClass('Class1');

//var_dump($reflection);
$constructor = $reflection->getConstructor();
$dependencies = [];
if (!is_null($constructor)) {
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

foreach ($dependencies as $index => $dependency) {
    var_dump($dependency->isInstantiable());
}

class MyContainer
{
    protected static $instance;

    /**
     * An array of the types that have been resolved.
     *
     * @var bool[]
     */
    protected $resolved = [];

    /**
     * The container's bindings.
     *
     * @var array[]
     */
    protected $bindings = [];

    /**
     * The parameter override stack.
     *
     * @var array[]
     */
    protected $with = [];

    /**
     * The container's shared instances.
     *
     * @var object[]
     */
    protected $instances = [];

    /**
     * Get the globally available instance of the container.
     *
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * Resolve the given type from the container.
     *
     * @param  string  $abstract
     * @param  array  $parameters
     * @return mixed
     *
     */
    public function make($abstract, array $parameters = [])
    {
        return $this->resolve($abstract, $parameters);
    }

    protected function resolve($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $this->with[] = $parameters;
    }
}

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
