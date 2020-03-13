<?php

$table = new \Swoole\Table(65536);

$table->column('data', \Swoole\Table::TYPE_STRING, 1);
$table->create();

$count = 10000;
for ($i = 1; $i <= $count; $i++) {
    $table->set($i, ['data' => '1']);
}
echo 'table before del count:' . $table->count() . PHP_EOL;

foreach ($table as $key => $item) {
    $table->del($key);
}

echo 'table after del count:' . $table->count() . PHP_EOL;
