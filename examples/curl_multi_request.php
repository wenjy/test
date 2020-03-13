<?php

/**
 * @param array $urls
 * @param int $timeout
 * @return array
 */
function curlMultiRequest(array $urls, int $timeout = 1): array
{
    $html = [];
    $curl_handles = [];
    // 创建批处理cURL句柄
    $mh = curl_multi_init();

    foreach ($urls as $key => $url) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL               => $url,
            CURLOPT_HEADER            => false,
            CURLOPT_USERAGENT         => 'Mozilla/5.0 Windows NT 10.0; Win64; x64 AppleWebKit/537.36 KHTML, like Gecko Chrome/68.0.3163.100 Safari/537.36',
            CURLOPT_CONNECTTIMEOUT    => $timeout,
            CURLOPT_RETURNTRANSFER    => true,
        ]);

        $curl_handles[$key] = $ch;
        curl_multi_add_handle($mh, $ch);
    }

    $active = null;
    //execute the handles
    do {
        $mrc = curl_multi_exec($mh, $active);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);

    while ($active && $mrc == CURLM_OK) {
        if (curl_multi_select($mh) != -1) {
            do {
                $mrc = curl_multi_exec($mh, $active);
            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }
    }

    foreach ($curl_handles as $key => $ch) {
        $html[$key] = curl_multi_getcontent($ch); // get the content
        // do what you want with the HTML
        curl_multi_remove_handle($mh, $ch); // remove the handle (assuming  you are done with it);
    }

    curl_multi_close($mh);
    return $html;
}

// 淘宝、腾讯Ip位置

function parameterSignature(array $params, string $path, string $sk)
{
    ksort($params);
    return md5($path . '?' . http_build_query($params) . $sk);
}
$sk = 'xx';
$path = '/ws/location/v1/ip';
$params['ip'] = '';
$params['key'] = 'xx';
$params['output'] = 'json';
$params['sig'] = parameterSignature($params, $path, $sk);

$urls['tencent'] = 'https://apis.map.qq.com' . $path . '?' . urlencode(http_build_query($params));
$urls['taobao'] = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $params['ip'];

$res = curlMultiRequest($urls);

$data = null;
$taobao = json_decode($res['taobao'], true);
if (json_last_error() === JSON_ERROR_NONE) {
    $data = $taobao;
}

$qq = json_decode($res['tencent'], true);
if (json_last_error() === JSON_ERROR_NONE) {
    $data = $qq;
}

var_dump($data);
