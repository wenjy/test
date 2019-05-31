<?php
/**
 * @author: 文江义
 * @date: 16:42 2019/5/29
 */
$url = 'http://shouji.360tpcdn.com/190522/68763a8dc486ec10ebcd367f55b34d2d/com.qihoo.video_176.apk';
$url = '';
$url = null;
$url = 'www.baidu.com';
var_dump(filter_var($url, FILTER_VALIDATE_URL));

class Aa
{
    public function test()
    {
        var_dump($this);
    }
}

$a = new Aa();
var_dump($a);

//$a->test();

class Bb
{
    public function __construct(Aa $a)
    {
        call_user_func([$a, 'test']);
    }
}

new Bb($a);

$entry = array(
    0 => 'foo',
    1 => false,
    2 => -1,
    3 => null,
    4 => '',
    5 => [],
);

var_dump(array_filter($entry));
