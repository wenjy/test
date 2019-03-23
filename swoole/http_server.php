<?php
$http = new swoole_http_server("0.0.0.0", 9503);

$http->on('request', function ($request, $response) {
    // 使用Chrome浏览器访问服务器，会产生额外的一次请求，/favicon.ico，可以在代码中响应404错误
    if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
        return $response->end();
    }
    var_dump($request->get, $request->post);
    $response->header("Content-Type", "text/html; charset=utf-8");
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});

$http->start();
