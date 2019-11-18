<?php
/**
 * @author: 文江义
 * @date: 18:35 2019/6/14
 */

// error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    /*if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting, so let it fall
        // through to the standard PHP error handler
        return false;
    }*/

    switch ($errno) {
        case E_USER_ERROR:
            echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
            echo "  Fatal error on line $errline in file $errfile";
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
            echo "Aborting...<br />\n";
            exit(1);
            break;

        case E_USER_WARNING:
            echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
            break;

        case E_USER_NOTICE:
            echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
            break;

        default:
//            echo "Unknown error type: [$errno] $errstr<br />\n";
            throw new Exception("Unknown error type: [$errno] $errstr");
            break;
    }

    /* Don't execute PHP internal error handler */
    return true;
}

// function to test the error handling
function scale_by_log($vect, $scale)
{
    if (!is_numeric($scale) || $scale <= 0) {
        trigger_error("log(x) for x <= 0 is undefined, you used: scale = $scale", E_USER_ERROR);
    }

    if (!is_array($vect)) {
        trigger_error("Incorrect input vector, array of values expected", E_USER_WARNING);
        return null;
    }

    $temp = array();
    foreach($vect as $pos => $value) {
        if (!is_numeric($value)) {
            trigger_error("Value at position $pos is not a number, using 0 (zero)", E_USER_NOTICE);
            $value = 0;
        }
        $temp[$pos] = log($scale) * $value;
    }

    return $temp;
}

// set to the user defined error handler
$old_error_handler = set_error_handler("myErrorHandler");

$str = pack('C3', 0x05, 0x01, 0x02);

try {
    $arr = [1,2];
//    var_dump($arr[3]);
//    var_dump($header_info = unpack('C1version/C1cmd/C1rsv/C1atyp', '1'));
    var_dump(unpack('C', false));
    var_dump(substr('', 2));
} catch (Exception $e) {
    var_dump($e->getMessage());
}

// trigger some errors, first define a mixed array with a non-numeric item
//echo "vector a\n";
//$a = array(2, 3, "foo", 5.5, 43.3, 21.11);
//print_r($a);

// now generate second array
//echo "----\nvector b - a notice (b = log(PI) * a)\n";
/* Value at position $pos is not a number, using 0 (zero) */
//$b = scale_by_log($a, M_PI);
//print_r($b);

// this is trouble, we pass a string instead of an array
//echo "----\nvector c - a warning\n";
/* Incorrect input vector, array of values expected */
//$c = scale_by_log("not array", 2.3);
//var_dump($c); // NULL

// this is a critical error, log of zero or negative number is undefined
//echo "----\nvector d - fatal error\n";
/* log(x) for x <= 0 is undefined, you used: scale = $scale" */
//$d = scale_by_log($a, -2.5);
//var_dump($d); // Never reached


