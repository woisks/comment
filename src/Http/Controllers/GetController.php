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

namespace Woisks\Comment\Http\Controllers;


use Woisks\Comment\Models\Services\GetServices;

/**
 * Class GetController.
 *
 * @package Woisks\Comment\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 14:51
 */
class GetController extends BaseController
{
    /**
     * getServices.  2019/7/20 14:51.
     *
     * @var  \Woisks\Comment\Models\Services\GetServices
     */
    private $getServices;

    /**
     * GetController constructor. 2019/7/20 14:51.
     *
     * @param \Woisks\Comment\Models\Services\GetServices $getServices
     *
     * @return void
     */
    public function __construct(GetServices $getServices)
    {
        $this->getServices = $getServices;
    }


    /**
     * get. 2019/7/20 14:51.
     *
     * @param $type
     * @param $numeric
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($type, $numeric)
    {
        $db = $this->getServices->get($type, $numeric);

        if ($db->isEmpty()) {
            return res(422, 'param error');
        }

        return res(200, 'success', $db);
    }
}