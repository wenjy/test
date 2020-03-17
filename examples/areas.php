<?php

$html = file_get_contents('http://www.mca.gov.cn/article/sj/xzqh/2020/2020/202003061536.html');

preg_match_all('/>(\d{6}).*\s*.*>([\x{4e00}-\x{9fa5}]+)<\/td>/u', $html, $matches);

$area_list = [];
foreach ($matches[1] as $key => $code) {
    $area_list[] = [
        'id' => $code,
        'name' => $matches[2][$key],
    ];
}
var_dump(count($area_list));
file_put_contents($file = __DIR__ . DIRECTORY_SEPARATOR . 'areas-a.json', json_encode($area_list, JSON_UNESCAPED_UNICODE ));
return;
$area_list = json_decode(file_get_contents($file), true);
$insert_data = [];
$city_pre = ['11', '12', '50', '31']; // 直辖市
$date = date('Y-m-d H:i:s');
foreach ($area_list as $area) {
    $data['id'] = $code = $area['id'];
    if (substr($code, -4, 4) === '0000') {
        $p_data[] = $area;
        $data['pid'] = 0;
    } elseif (substr($code, -2, 2) === '00') {
        $c_data[] = $area;
        $data['pid'] = substr($code, 0, 2) . '0000';
    } else {
        $d_data[] = $area;
        if (in_array(substr($code, 0, 2), $city_pre)) {
            $data['pid'] = substr($code, 0, 2) . '0000';
        } else {
            $data['pid'] = substr($code, 0, 4) . '00';
        }
    }
    $data['name'] = $area['name'];
    $data['created_at'] = $date;
    $insert_data[] = $data;
}
return;
