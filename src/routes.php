<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Grove  <bolelin@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */


Route::prefix('comment')
    ->middleware('throttle:60,1')
    ->namespace('Woisks\Comment\Http\Controllers')
    ->group(function () {

        //获取评价的回复
        Route::get('/reply/{id}', 'GetController@reply')->where(['id' => '[0-9]+']);

        //根据模块获取评价
        Route::get('/{type}/{numeric}', 'GetController@comment')->where(['type' => '[a-z_a-z]+', 'numeric' => '[0-9]+']);

        Route::middleware('token')->group(function () {

            Route::post('/', 'CreateController@create');
            Route::post('/update', 'UpdateController@update');
            Route::post('reply', 'ReplyController@reply');
            Route::post('/del/{id}', 'DelController@del')->where(['id' => '[0-9]+']);

        });

    });
