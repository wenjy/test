<?php

function random($length = 16)
{
    $string = '';

    while (($len = strlen($string)) < $length) {
        $size = $length - $len;

        $bytes = random_bytes($size);

        $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
    }

    return $string;
}

$children = [];

for ($i = 0; $i < 10; $i++) {
    $child_pid = pcntl_fork();

    if ($child_pid == -1) {
        exit('start worker error');
    } elseif ($child_pid == 0) {
        /*if (function_exists('mt_srand')) {
            mt_srand(); //子进程重新播种
        }*/
        $redis = new \Redis();
        $redis->connect('');
        $redis->auth('');
        $set_key = 'test_random';
        $num = 0;
        for ($a = 0; $a < 10; $a++) {
            $values = [];
            for ($j = 0; $j < 3000; $j++) {
                $values[] = random(8);
                $num++;
            }
            $redis->sAdd($set_key, ...$values);
        }
        var_dump($num);
        exit(0);
    } else {
        $children[$child_pid] = [
            'start_time' => time(),
        ];
    }
}

while (true) {
    $status = 0;
    $pid = pcntl_wait($status, WUNTRACED);

    if ($pid > 0) {
        unset($children[$pid]);
    }

    if (count($children) == 0) {
        exit(0);
    }
}
