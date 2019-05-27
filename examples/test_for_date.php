<?php
/**
 * @author: 文江义
 * @date: 12:02 2019/5/5
 */

$start_date = '2019-04-01';
$end_date = '2019-04-03';
for ($i = $start_date; $i <= $end_date; $i = date('Y-m-d', strtotime($i . ' +1 days'))) {
    $xaxis_data[] = $i;
}
var_dump($xaxis_data);

$start  = 'A';
$end = 'I';
for ($i = $start; $i <= $end; $i++) {
    echo $i;
}
/*echo PHP_EOL;
$z = 'Z';
echo ++$z;
echo PHP_EOL;
echo ++$z;*/

/*echo PHP_EOL;
$start  = 'AA';
$end = 'AF';
for ($i = $start; $i <= $end; $i++) {
    echo $i;
}*/

echo PHP_EOL;
$start  = 'A';
$end = 'AZ';
for ($i = $start; $i <= $end; $i++) {
    echo $i;
}

/*echo PHP_EOL;
$start  = 'A1';
$end = 'A5';
for ($i = $start; $i <= $end; $i++) {
    echo $i;
}*/
