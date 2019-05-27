<?php
/**
 * @author: 文江义
 * @date: 17:09 2019/5/23
 */

function num2alpha($intNum, $isLower = true)
{
    $num26 = base_convert($intNum, 10, 26);
    $addcode = $isLower ? 49 : 17;
    $result = '';
    for ($i = 0; $i < strlen($num26); $i++) {
        $code = ord($num26{$i});
        if ($code < 58) {
            $result .= chr($code + $addcode);
        } else {
            $result .= chr($code + $addcode - 39);
        }
    }
    echo $result . PHP_EOL;
    return $result;
}

// 0 -9 a-p 25
var_dump(base_convert(25, 10, 26));

/**
 * Converts an integer into the alphabet base (A-Z).
 *
 * @param int $n This is the number to convert.
 * @return string The converted number.
 * @author Theriault
 *
 */
function num2alpha1($n) {
    $r = '';
    // 0x61 a 0x41 A
    for ($i = 1; $n >= 0 && $i < 10; $i++) {
        $r = chr(0x41 + ($n % pow(26, $i) / pow(26, $i - 1))) . $r;
        $n -= pow(26, $i);
    }
    return $r;
}

var_dump(num2alpha1(25));

