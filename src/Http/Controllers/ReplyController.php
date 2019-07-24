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
use Woisks\Comment\Http\Requests\ReplyRequest;
use Woisks\Comment\Models\Services\ReplyServices;
use Woisks\Jwt\Services\JwtService;

/**
 * Class ReplyController.
 *
 * @package Woisks\Comment\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 14:17
 */
class ReplyController extends BaseController
{
    /**
     * replyServices.  2019/7/20 14:17.
     *
     * @var  \Woisks\Comment\Models\Services\ReplyServices
     */
    private $replyServices;

    /**
     * ReplyController constructor. 2019/7/20 14:17.
     *
     * @param \Woisks\Comment\Models\Services\ReplyServices $replyServices
     *
     * @return void
     */
    public function __construct(ReplyServices $replyServices)
    {
        $this->replyServices = $replyServices;
    }


    /**
     * reply. 2019/7/24 14:14.
     *
     * @param \Woisks\Comment\Http\Requests\ReplyRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function reply(ReplyRequest $request)
    {
        $type = $request->input('type');
        $numeric = $request->input('numeric');
        $content = $request->input('content');
        $parent = $request->input('parent');

        $count_db = $this->replyServices->count($type);
        if (!$count_db) {
            return res(422, 'param type error or not exists');
        }

        $parent_db = $this->replyServices->first($parent);
        if (!$parent_db) {
            return res(422, 'parent id  not exists');
        }
        try {
            DB::beginTransaction();

            $count_db->increment('count');
            $parent_db->increment('count');
            $comment_db = $this->replyServices->comment($type, $numeric, $content, $parent, JwtService::jwt_account_uid());
        } catch (Throwable $e) {
            DB::rollBack();

            return res(422, 'param error');
        }

        DB::commit();

        return res(200, 'success', $comment_db);
    }
}