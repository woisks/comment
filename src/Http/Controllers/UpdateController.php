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


use Illuminate\Http\JsonResponse;
use Woisks\Comment\Http\Requests\UpdateRequest;
use Woisks\Comment\Models\Repository\CommentRepository;
use Woisks\Jwt\Services\JwtService;

/**
 * Class UpdateController.
 *
 * @package Woisks\Comment\Http\Controllers
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/8/4 21:33
 */
class UpdateController extends BaseController
{
    /**
     * commentRepo.  2019/8/4 21:33.
     *
     * @var  CommentRepository
     */
    private $commentRepo;

    /**
     * UpdateController constructor. 2019/8/4 21:33.
     *
     * @param CommentRepository $commentRepo
     *
     * @return void
     */
    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }


    /**
     * update. 2019/8/4 21:33.
     *
     * @param UpdateRequest $request
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request)
    {
        $id      = $request->input('id');
        $content = $request->input('content');

        $db = $this->commentRepo->first($id);
        if (!$db) {
            return res(404, 'comment not exists ');
        }

        //验证权限
        if ($db->account_uid != JwtService::jwt_account_uid()) {
            return res(409, 'data not exists ');
        }

        $db->content = $content;
        if ($db->save()) {
            return res(200, 'success');
        }
        return res(500, 'Come back later');
    }


}
