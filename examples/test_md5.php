<?php

$arr1 = [1];
$arr2 = [2 => 2];
var_dump($arr1 + $arr2);exit;
$str = "aaa\\nbbb";
echo $str;
date_default_timezone_set('PRC');
var_dump(date('Y-m-d H:i:s', 1578094095));
var_dump(strtotime('2040-01-01 00:00:00'));
$query['start_date'] = date('Y-m-d', strtotime('-31 days'));
$query['end_date'] = date('Y-m-d', strtotime(' +1 days'));
var_dump($query);exit;
$urlOne = 'http://192.169.2.200/index.php?user/publicLink&fid=fd5cdfj4I-Al2LaRzsbg_cKWgX_q-gMIPgBm_kiH-J3F0APCbn7myhb3nYI4QLqGGnh5zgta_rIAq4R34cUjN-j-jzifOiAUhq228-rZTutFS6pRc2lnm3r8dOiCqsFhzr0COJpIbOZ25IfxbiCk-kASADf3xETscmvT5zug51e9GA&file_name=/A2019010902-%E5%8D%93%E4%BB%95%E6%9E%97-%E6%9E%81%E6%B6%A6%E5%A5%97%E8%A3%85-%E7%89%88%E6%9C%AC2.mp4';
$urlTwo = 'http://192.169.2.200/index.php?user/publicLink&fid=fd5cdfj4I-Al2LaRzsbg_cKWgX_q-gMIPgBm_kiH-J3F0APCbn7myhb3nYI4QLqGGnh5zgta_rIAq4R34cUjN-j-jzifOiAUhq228-rZTutFS6pRc2lnm3r8dOiCqsFhzr0COJpIbOZ25IfxbiCk-kASADf3xETscmvT5zug51e9GA&file_name=/A2019010902-%E5%8D%93%E4%BB%95%E6%9E%97-%E6%9E%81%E6%B6%A6%E5%A5%97%E8%A3%85-%E7%89%88%E6%9C%AC2.mp4';
$urlOne = 'http://192.168.2.200/index.php?user/publicLink&fid=fd5cdfj4I-Al2LaRzsbg_cKWgX_q-gMIPgBm_kiH-J3F0APCbn7myhb3nYI4QLqGGnh5zgta_rIAq4R34cUjN-j-jzifOiAUhq228-rZTutFS6pRc2lnm3r8dOiCqsFhzr0COJpIbOZ25IfxbiCk-kASADf3xETscmvT5zug51e9GA&file_name=/A2019010902-%E5%8D%93%E4%BB%95%E6%9E%97-%E6%9E%81%E6%B6%A6%E5%A5%97%E8%A3%85-%E7%89%88%E6%9C%AC2.mp4';

$len = strlen($urlOne);
for ($i = 0;$i<$len;$i++) {
    if ($urlOne[$i] !== $urlTwo[$i]) {
        var_dump($i);
        var_dump($urlOne[$i]);
        var_dump($urlTwo[$i]);
    }
}
if ($urlOne === $urlTwo) {
    echo 'eq' . PHP_EOL;
}
echo md5($urlTwo). PHP_EOL; // 4effae6a2f437ee5fffe5627bdfa07a2
echo  mb_detect_encoding($urlTwo). PHP_EOL;  // ASCII

echo md5($urlOne). PHP_EOL;  // add8978f0d77f8a451fb5b9d37fee985
echo mb_detect_encoding($urlOne). PHP_EOL;  // ASCII
