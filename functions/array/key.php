<?php
/**
mixed key ( array &array )
key() 返回数组中当前单元的键名。
*/

$array = array(
 'fruit1' => 'apple',
 'fruit2' => 'orange',
 'fruit3' => 'grape',
 'fruit4' => 'apple',
 'fruit5' => 'apple');

// this cycle echoes all associative array
// key where value equals "apple"
while ($fruit_name = current($array)) {
    if ($fruit_name == 'apple') {
        echo key($array).'<br />';
    }
    next($array);
}
