<?php
/**
 * @author: jiangyi
 * @date: 下午10:05 2019/3/13
 */

function xrange($start, $end, $step = 1)
{
    for ($i = $start; $i <= $end; $i += $step) {
        yield $i;
    }
}

$range = xrange(1, 10);
// 是一个迭代器
//var_dump($range);
//var_dump($range instanceof Iterator);


function logger($fileName)
{
    $fileHandle = fopen($fileName, 'a');
    while (true) {
        // yield作为接受者，是调用send的值
        fwrite($fileHandle, yield . "\n");
    }
}

/* @var $logger Generator */
$logger = logger(__DIR__ . '/log');
//var_dump($logger);
$logger->send('Foo');
$logger->send('Bar');

function gen()
{
    $ret = (yield 'yield1');
    var_dump($ret);
    $ret = (yield 'yield2');
    var_dump($ret);
}

/* @var $gen Generator */
//$gen = gen();
// 返回当前产生的值
// var_dump($gen->current());
// 返回当前产生的键
//var_dump($gen->key());
// 生成器继续执行
//var_dump($gen->next());
// 重置迭代器
//var_dump($gen->rewind());
// 向生成器中传入一个值
//$gen->send('aa');
// 向生成器中抛入一个异常
//$gen->throw();
// 检查迭代器是否被关闭
// $gen->valid();

//var_dump($gen->current());    // 第一个yield的值 string(6) "yield1"
//var_dump($gen->send('ret1')); // 第一个var_dump string(4) "ret1"   (the first var_dump in gen)
// 第二个yield的值，send返回的 string(6) "yield2" (the var_dump of the ->send() return value)
//var_dump($gen->current()); // string(6) "yield2"
//var_dump($gen->send('ret2')); // 第二个var_dump的值 string(4) "ret2"   (again from within gen)
// 没有yield返回值 NULL               (the return value of ->send())

/*function gen2() {
    $ret = yield 'foo';
    var_dump($ret);
    yield 'bar';
}*/

//$gen = gen2();
//var_dump($gen->current());
//var_dump($gen->send('something'));

