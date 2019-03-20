<?php
/**
 * Created by PhpStorm.
 * User: jiangyi
 * Date: 2017/8/5
 * Time: 上午8:48
 */

session_start();
$_SESSION['aaaa'] = 123;
var_dump($_SESSION['aaaa']);