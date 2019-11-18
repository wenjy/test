<?php
/**
 * @author: 文江义
 * @date: 17:35 2019/9/29
 */
function gen() {
    $ret = (yield 'yield1');
    var_dump($ret);
    $ret = (yield 'yield2');
    var_dump($ret);
    $ret = (yield 'yield3');
    var_dump($ret);
    return 123;
}

$gen = gen();
var_dump($gen->current());    // string(6) "yield1"
var_dump($gen->current());    // string(6) "yield1"
var_dump($gen->current());    // string(6) "yield1"
//var_dump($gen->send('ret1')); // string(4) "ret1"   (the first var_dump in gen)
// string(6) "yield2" (the var_dump of the ->send() return value)
//var_dump($gen->current());// string(6) "yield2"
//var_dump($gen->send('ret2')); // string(4) "ret2"   (again from within gen)
// NULL               (the return value of ->send())
//var_dump($gen->current());// string(6) "yield3"
//var_dump($gen->send('ret3'));// string(6) "yield3"
