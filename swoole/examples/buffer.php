<?php
$buffer = new swoole_buffer;
$buffer->append(str_repeat("A", 10));
$buffer->append(str_repeat("B", 20));
$buffer->append(str_repeat("C", 30));

var_dump($buffer);
// capacity->128 length->60
echo $buffer->substr(0, 10, true) . "\n";
echo $buffer->substr(0, 20, true) . "\n";
echo $buffer->substr(0, 30) . "\n";
$buffer->clear();

// PHP Warning:  Swoole\Buffer::substr(): offset(0, 10) is out of bounds.
echo $buffer->substr(0, 10, true) . "\n";
var_dump($buffer);
// length->0
sleep(1);
