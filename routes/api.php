<?php

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {

    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {

        $api->get('/', 'HomeController@index');
        
        $api->post('user/login', 'AuthController@login');
        $api->post('user/register', 'AuthController@register');

        //需验证接口,请求Header 中添加 Authorization = bearer token_value，通过login或register获取toeken
        //token过期时间为   失效后的第一次请求会refresh token , 并在响应头中返回新的token
        $api->group(['middleware' => 'refresh.token'], function ($api) {

            $api->get('user/info', 'AuthController@info');
            $api->get('user/logout', 'AuthController@logout');

        });
    });
});
