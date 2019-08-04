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
use Woisks\Comment\Models\Repository\CommentRepository;
use Woisks\Comment\Models\Repository\TypeRepository;
use Woisks\Jwt\Services\JwtService;

/**
 * Class DelController.
 *
 * @package Woisks\Comment\Http\Controllers
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/7/28 11:00
 */
class DelController extends BaseController
{
    /**
     * commentRepo.  2019/7/28 10:18.
     *
     * @var  CommentRepository
     */
    private $commentRepo;

    /**
     * typeRpo.  2019/7/28 10:18.
     *
     * @var  TypeRepository
     */
    private $typeRpo;

    /**
     * DelController constructor. 2019/7/28 11:01.
     *
     * @param CommentRepository $commentRepo
     * @param TypeRepository $typeRpo
     *
     * @return void
     */
    public function __construct(CommentRepository $commentRepo,
                                TypeRepository $typeRpo)
    {
        $this->commentRepo = $commentRepo;
        $this->typeRpo     = $typeRpo;
    }


    /**
     * del. 2019/8/4 11:00.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function del($id)
    {
        if (strlen($id) != 18 && strlen($id) != 19 && !is_int($id)) {
            return res(422, 'param id error');
        }
        try {
            \DB::beginTransaction();

            if (!$comment = $this->commentRepo->first($id)) {
                //验证评价ID
                return res(404, 'param id not exists ');
            }

            if ($comment->account_uid != JwtService::jwt_account_uid()) {
                //验证权限
                return res(404, 'your comment not exists ');
            }

            if ($comment->count != 0) {
                return res(409, 'reply not empty delete error');
            }

            $this->typeRpo->decrement($comment->type);
            $comment->delete();

        } catch (\Throwable $e) {

            \DB::rollBack();
            return res(500, 'Come back later');
        }
        \DB::commit();
        return res(200, 'success');


    }
}
