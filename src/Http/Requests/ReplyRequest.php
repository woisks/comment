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
 * Class ReplyRequest.
 *
 * @package Woisks\Comment\Http\Requests
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 13:45
 */
class ReplyRequest extends Requests
{

    /**
     * rules. 2019/7/20 13:45.
     *
     *
     * @return array|mixed
     */
    public function rules()
    {
        return [
            'type'    => 'required|string|min:2|max:20',
            'content' => 'required|string|min:1|max:255',
            'parent'  => 'required|numeric|digits_between:18,19'
        ];
    }
}