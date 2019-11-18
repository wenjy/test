<?php
/**
 * @author: 文江义
 * @date: 15:03 2019/6/3
 * 本函数不是用来验证给定 URL 的合法性的，只是将其分解为下面列出的部分。不完整的 URL 也被接受，parse_url() 会尝试尽量正确地将其解析。
 */

//$url = 'http://username:password@www1.www2.twst.com/path?arg=value#anchor';
$host = 'www1.www2.twst.com';
//$host = 'twst.com';

//var_dump(parse_url($url));

function getMainHost($host)
{
    //$host = parse_url($url, PHP_URL_HOST);

        $arr = explode('.', $host);
    $count = count($arr);
        return $arr[$count-2] .'.'. $arr[$count-1];

}

var_dump(getMainHost($host));
