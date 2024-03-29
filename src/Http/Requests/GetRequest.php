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

namespace Woisks\Comment\Http\Requests;


/**
 * Class GetRequest.
 *
 * @package Woisks\Comment\Http\Requests
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 14:21
 */
class GetRequest extends Requests
{
    /**
     * rules. 2019/7/20 14:21.
     *
     *
     * @return array|mixed
     */
    public function rules()
    {
        return [
            'type'    => 'required|string|min:1|max:20',
            'numeric' => 'required|numeric|digits_between:18,19'
        ];
    }

}