<?php
/**
 * @author: jiangyi
 * @date: 下午1:39 2017/12/22
 */

$arr1 = [1,2,3];
$arr2 = [4,5];
//var_dump(array_intersect($arr1, $arr2));

foreach ($arr2 as $v) {
    foreach ($arr1 as $val) {
        echo $val;
        if ($val == 2) {
            break 2;
        }
    }
}

$arr3 = [['id'=>12,'num'=>1],['id'=>33,'num'=>2]];
$str = json_encode($arr3);
$obj = json_decode($str);
//var_dump(json_decode(json_encode($obj), true));

$arr4 = [1,3,2,6,5];
rsort($arr4, SORT_NUMERIC);

//var_dump($arr4);

$num = 1;
$arr['price'] = round(1/3, 2);

//var_dump(json_encode($arr));

$attributeRegex = '/(^|.*\])([\w\.\+]+)(\[.*|$)/u';
$attribute = '[0]key';
$attribute = 'key[0]';
$attribute = 'key[]';
preg_match($attributeRegex, $attribute, $match);
//var_dump($match);

$arr = '1,2,,4,';
//var_dump(explode(',', trim($arr, ',')));

$line_color = ['r'=>'20','g'=>'175','b'=>'253'];
//var_dump(json_encode($line_color));

$str = '["测试11","测试22"]';
//var_dump(json_decode($str));

$arr = [1,2];

//var_dump(array_sum($arr));

//var_dump(round(0));

$str = <<<EOT
aaaaaaaa
EOT;

//var_dump($str);

function sum(...$numbers) {
    $acc = 0;
    foreach ($numbers as $n) {
        $acc += $n;
    }
    return $acc;
}

//var_dump(sum(1, 2, 3, 4));

function add($a, $b) {
    return $a + $b;
}
//var_dump(add(...[1, 2, 3]));

function sum1() {
    $acc = 0;
    foreach (func_get_args() as $n) {
        $acc += $n;
    }
    return $acc;
}

//var_dump(sum1(1, 2, 3, 4));

$arr = [1=>'a',2=>'b'];
//$str = $arr[3] ?? 'c';
//var_dump($str);

$arr = ['1-2' => ['a'=>'a','s'], '1-3' => ['a','e']];
//var_dump(array_values($arr));

$str = '请求玩玩啊';
preg_match('/^[\x{4e00}-\x{9fa5}]{2,4}$/u',$str, $match1);

var_dump($match1);
//$_class['a'] = 123;
function &load_class($class)
{
    static $_class = array();
    if (isset($_class['class1'])) {
        return $_class['class1'];
    }
    return $_class[$class] = 'CI_'.$class;
}

//load_class('class1');
//$class = load_class('class2');
//var_dump($class);

function Test()
{
    static $a = 0;
    echo $a."\n";
    $a++;
}

//Test();
//Test();
//Test();

function &func(){
    static $static = 0;
    $static++;
    return $static;
}

$var1 =& func();
echo "var1:", $var1; // 1
func();
func();
echo "var1:", $var1; // 3
$var2 = func(); // assignment without the &
echo "var2:", $var2; // 4
func();
func();
echo "var1:", $var1; // 6
echo "var2:", $var2; // still 4

require_once './yield/config.php';

require_once 'config.php';

var_dump($config);

$array = array(
    'parameters' => 'abcdef',
    'items'		=> 'lots of them',
    'something' => 'thanks',
    array (
        'mutli-dimensional' => 'Hey hey',
    )
);

// Now compact the data
//$data = serialize($array);
//echo $data;

//var_dump(unserialize($data));

function test1()
{
    return ['a' => 123];
}

echo test1()['a'];

$str = '';

//$str[1]['a'] = 1;


function responseImage($postObj, $media_id)
{
    $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[image]]></MsgType>
                        <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                        </Image>
                    </xml>";

    return sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time(), $media_id);
}

$post_obj = (object)array('FromUserName'=>'o1yCkwo5CPQ6kkw7LXrTo1kBgvpM', 'ToUserName'=>'wx1d08757f92bb8fff');
$media_id = 12313;
//var_dump(responseImage($post_obj, $media_id));

$arr = [];
$price = 1;
for ($i=260; $i<277; $i++) {
    $arr[$i] = [
        'sku_leader_price' => $price,
        'sku_price' => $price,
    ];
    $price ++;
}
//echo json_encode($arr);
$arr = [
    'add_sale' => 'member/after_sale/detail/{order_item_id}',  // 申请售后
    'sale_detail' => 'member/after_sale/detail/{order_item_id}/{after_sale_id}',   // 售后详情
    'goods_detail' => 'goods/detail/{product_id}',
    'goods_detail1' => 'goods/detail/',
];
$order_item_id = 1;
$after_sale_id = 2;
//$product_id = 3;
/*foreach ($arr as $key => $rule) {
    preg_match_all('/\{[a-z_]{1,}\}/', $rule,$match22);
    if ($match22[0]) {
        foreach ($match22[0] as $item) {
            $var = trim($item, '{}');
            if (isset($$var)) {
                $arr[$key] = str_replace($item, $$var, $arr[$key]);
            } else {
                $arr[$key] = str_replace($item, 0, $arr[$key]);
            }
        }
    }
}*/

$params = [
    'order_item_id' => 1,
    'after_sale_id' => 2,
    'product_id' => 3,
];
$arr = preg_replace_callback('/\{[a-z_]{1,}\}/', function ($matches) use ($params) {

    if ($matches) {
        foreach ($matches as $match) {
            $var = trim($match, '{}');
            if (isset($params[$var])) {
                return $params[$var];
            } else {
                return 0;
            }
        }
    }
}, $arr);

//var_dump($arr);

/**
 * Simple function to replicate PHP 5 behaviour
 */
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

class ClassA
{
    public $a;
    public $b;
    public function __construct($a, $b = 3)
    {
        $this->a = $a;
        $this->b = $b;
    }
}

$class = new ReflectionClass('ClassA');
var_dump($class->isInstantiable());
$instance = $class->newInstanceArgs(array('substr'));
var_dump($instance);

echo md5('wenjiangyi');




