<?php
include __DIR__ . '/vendor/autoload.php'; // 引入 composer 入口文件
use EasyWeChat\Foundation\Application;
$options = [
    'debug'  => true,
    'app_id' => 'wx9d2be0f76f19dcc8',
    'secret' => 'd11ba24cde7164df573624b4cfde9a33',
    'token'  => 'easywechat',
    // 'aes_key' => null, // 可选
    'log' => [
        'level' => 'debug',
        'file'  => '/tmp/food-info.ngrok.sinomoses.com', // XXX: 绝对路径！！！！
    ],
    //...
];
$app = new Application($options);
$response = $app->server->serve();
var_dump($response);
exit();
// 将响应输出
//$response->send(); // Laravel 里请使用：return $response;
return $response;


