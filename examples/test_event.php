<?php
/**
 * @author: jiangyi
 * @date: 22:36 2020-03-18
 */
$base = new EventBase();
$n = 2;
echo time() . PHP_EOL;
$e = Event::timer($base, function($n) use (&$e) {
    echo "$n seconds elapsed\n";
    echo time();
    $e->delTimer();
}, $n);
$e->addTimer($n);
$base->loop();
