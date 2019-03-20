<?php
/**
 * 可变变量.
 * User: jiangyi
 * Date: 2017/5/8
 * Time: 下午9:47
 */

/*$a = 'hello';

$$a = 'world';

echo "$a ${$a}";//hello world*/

/*class foo {
    var $bar = 'I am bar.';
    var $arr = array('I am A.', 'I am B.', 'I am C.');
    var $r   = 'I am r.';
}

$foo = new foo();
$bar = 'bar';
$baz = array('foo', 'bar', 'baz', 'quux');
echo $foo->$bar . "\n";
//会有notice
//echo $foo->$baz[1] . "\n";
echo $foo->{$baz[1]} . "\n";

$start = 'b';
$end   = 'ar';
echo $foo->{$start . $end} . "\n";

$arr = 'arr';
echo $foo->$arr[1] . "\n";
echo $foo->{$arr}[1] . "\n";*/


/*$he = 'loves';
$loves = 'you';
$you = 'he';
echo $$$he." ".$$$$he." ".$$he;*/

/*$geolocation = array("ip"=>"127.0.0.1", "location" => array("city" =>
    "Knoxville", "state_province" => "TN", "country" => "USA"));

print_r($geolocation);
// Array ( [ip] => 127.0.0.1 [location] => Array ( [city]
//=> Knoxville [state_province] => TN [country] => USA ) )

// typical use of variable variables
$key = "ip";
$result = $geolocation[$key];
print_r($result); // 127.0.0.1

$key = "location"; // another typical use of variable variables
$result = $geolocation[$key];
print_r($result);
// Array ( [city] => Knoxville [state_province] => TN[country] => USA )

// but how do we go deeper? this does NOT work
$key = "location['city']";
// $result = $geolocation[$key]; // Notice: Undefined index: location['city']
// print_r($result);

// this does NOT work
$key = "['location']['city']";
// $result = $geolocation{$key}; // Notice: Undefined index: ['location']['city']
// print_r($result);

// this works:
$key = "['location']['city']";
$result = eval('echo $geolocation'."$key;");
print_r($result); // Knoxville*/


/*//preg_replace_callback
// 将文本中的年份增加一年.
$text = "April fools day is 04/01/2002\n";
$text.= "Last christmas was 12/24/2001\n";
// 回调函数
function next_year($matches)
{
    // 通常: $matches[0]是完成的匹配
    // $matches[1]是第一个捕获子组的匹配
    // 以此类推
    return $matches[1].($matches[2]+1);
}
echo preg_replace_callback(
    "/(\d{2}\/\d{2}\/)(\d{4})/",
    "next_year",
    $text);*/

/*$welcome = getImportedString();
$firstname = "David";
$lastname = "Forger";

function getImportedString()
{
    return 'Dear $firstname $lastname, welcome to our Homepage';
}

echo $welcome;
// before replacement output will be:
//"Dear $firstname $lastname, welcome to our Homepage"

function replaceVars($match) {
    //return $GLOBALS[$match[1]];
    var_dump($match[1]);
    return $match[1];
}
$welcome = preg_replace_callback('/\$(\w+)/i', "replaceVars", $welcome);
echo $welcome;
//now output will be:
//"Dear David Forger, welcome to our Homepage"*/

/*class A
{
    function commond_method_inside_framework()
    {
        echo "This is class " . get_class($this).'::'.__FUNCTION__.' '. __METHOD__.' '."<br>";
    }
}

class B1 extends A
{
    function commond_method_inside_caller()
    {
        echo "This is class " . get_class($this).'::'.__FUNCTION__.' '. __METHOD__.' '."<br>";
    }
}

$a = new A();
$a->commond_method_inside_framework();

$b = new B1();
$b->commond_method_inside_framework();

$b->commond_method_inside_caller();*/

/*class A
{
    function sayClassFromObjectA()
    {
        echo "<br/>This is class " . __CLASS__;
    }
}

class B extends A
{
    function sayClassFromObjectB()
    {
        echo "<br/>This is class " . __CLASS__;
    }
}

$b = new B();

//I expect it to output "This is class B".
$b->sayClassFromObjectA();    //Outputs "This is class A"


//I expect it to output "This is class B".
$b->sayClassFromObjectB();    //Outputs "This is class B"*/


/*trait PeanutButter {
    function traitName() {echo __TRAIT__;}
}

trait PeanutButterAndJelly {
    use PeanutButter;
}

class Test {
    use PeanutButterAndJelly;
}

(new Test)->traitName(); //PeanutButter*/

/*class Base {
    public function sayHello() {
        echo 'Hello ';
    }
}

trait SayWorld {
    public function sayHello() {
        parent::sayHello();
        echo 'World！';
    }
}

class MyHelloWorld extends Base {
    use SayWorld;//覆盖基类
    public function sayHello()
    {
        echo '覆盖trait!';
    }
}

$o = new MyHelloWorld();
$o->sayHello();*/

/*trait HelloWorld {
    public function sayHello() {
        echo 'Hello World!';
    }
}

class TheWorldIsNotEnough {
    use HelloWorld;
    public function sayHello() {
        echo 'Hello Universe!';
    }
}

$o = new TheWorldIsNotEnough();
$o->sayHello();*/

/*trait Hello {
    public function sayHello() {
        echo 'Hello ';
    }
}

trait World {
    public function sayWorld() {
        echo 'World';
    }
}

class MyHelloWorld {
    use Hello, World;
    public function sayExclamationMark() {
        echo '!';
    }
}

$o = new MyHelloWorld();
$o->sayHello();
$o->sayWorld();
$o->sayExclamationMark();*/

$n = 3;
echo $n * --$n - $n;

$n = 3;
echo $n * $n++ - $n;
