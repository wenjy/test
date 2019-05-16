<?php
/**
 * @author: 文江义
 * @date: 9:18 2019/5/16
 */

$array = ['€', 'http://example.com/some/cool/page', '337'];
$bad   = json_encode($array);
$good  = json_encode($array,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

// $bad would be  ["\u20ac","http:\/\/example.com\/some\/cool\/page","337"]
// $good would be ["€","http://example.com/some/cool/page",337]
