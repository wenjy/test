<?php
$a = true;
$a++;
var_dump($a);return;
/*$a = true;
if ($a) {
    echo "true";
} else label: {
    echo "false";
}*/

$array = [1, 2, 3];
if (count($array) == 0) {
    echo '空数组';
    //数组为空的逻辑
} else for ($i = 0; $i < count($array); $i++) {
    echo $array[$i];
}
