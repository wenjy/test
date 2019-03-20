<?php
$array = [
    ['name' => 'butch', 'sex' => 'm', 'breed' => 'boxer'],
    ['name' => 'fido', 'sex' => 'm', 'breed' => 'doberman'],
    ['name' => 'girly', 'sex' => 'f', 'breed' => 'poodle'],
];

foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($array)) as $key => $value) {
    echo $key . '->' . $value . PHP_EOL;
}
