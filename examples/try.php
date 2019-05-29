<?php
/**
 * @author: 文江义
 * @date: 11:52 2019/5/22
 */

function test()
{
    try {
        echo 11111;
        throw new Exception(111);
        return 44444;
    } catch (Exception $e) {
        echo 22222;
    } finally {
        echo 33333;
    }
}

$info['update_url'] = 'http://apk.fr18.mmarket.com/cdn/rs/publish10/prepublish11/21/2019/05/15/a959/245/52245959/huoshanxiaoshipin_daluomakeji.apk?cid=300011003049&gid=999100002000000000000000000300011003049&ts=201905152359&tk=A7EB&v=1';

var_dump(pathinfo(parse_url($info['update_url'])['path'], PATHINFO_EXTENSION));

var_dump(test());

var_dump((array)true);
