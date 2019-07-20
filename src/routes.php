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
     ->namespace('Woisks\Comment\Http\Controllers')
     ->group(function () {

         Route::any('create', 'CreateController@create');
         Route::any('reply', 'ReplyController@reply');
         Route::any('/{type}/{numeric}', 'GetController@get')->where(['type' => '[a-z]+', 'numeric' => '[0-9]+']);

     });