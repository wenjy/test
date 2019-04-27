<?php
/**
*bool array_key_exists ( mixed key, array search )
*array_key_exists() 在给定的 key 存在于数组中时返回 TRUE。key 可以是任何能作为数组索引的值。array_key_exists() 也可用于对象。
*/

$search_array = array('first' => 1, 'second' => 4);
if (array_key_exists('first', $search_array)) {
    echo "The 'first' element is in the array";
}

//isset() 对于数组中为 NULL 的值不会返回 TRUE，而 array_key_exists() 会。 
$search_array = array('first' => null, 'second' => 4);

// returns false
var_dump(isset($search_array['first']));

// returns true
var_dump(array_key_exists('first', $search_array));
