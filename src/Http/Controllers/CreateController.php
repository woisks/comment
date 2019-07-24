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


use DB;
use Throwable;
use Woisks\Comment\Http\Requests\CreateRequest;
use Woisks\Comment\Models\Services\CreateServices;
use Woisks\Jwt\Services\JwtService;

/**
 * Class CreateController.
 *
 * @package Woisks\Comment\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 14:17
 */
class CreateController extends BaseController
{
    /**
     * createServices.  2019/7/20 14:17.
     *
     * @var  \Woisks\Comment\Models\Services\CreateServices
     */
    private $createServices;

    /**
     * CreateController constructor. 2019/7/20 14:17.
     *
     * @param \Woisks\Comment\Models\Services\CreateServices $createServices
     *
     * @return void
     */
    public function __construct(CreateServices $createServices)
    {
        $this->createServices = $createServices;
    }


    /**
     * create. 2019/7/24 13:30.
     *
     * @param \Woisks\Comment\Http\Requests\CreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function create(CreateRequest $request)
    {
        $type = $request->input('type');
        $numeric = $request->input('numeric');
        $content = $request->input('content');

        $count_db = $this->createServices->count($type);

        if (!$count_db) {
            return res(422, 'param type error or not exists');
        }
        try {
            DB::beginTransaction();

            $count_db->increment('count');
            $comment_db = $this->createServices->comment($type, $numeric, $content, JwtService::jwt_account_uid());
        } catch (Throwable $e) {
            DB::rollBack();

            return res(422, 'param error');
        }

        DB::commit();

        return res(200, 'success', $comment_db);
    }

}