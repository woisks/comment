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
use Woisks\Comment\Models\Repository\CommentRepository;
use Woisks\Comment\Models\Repository\TypeRepository;
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
     * commentRepo.  2019/7/20 13:58.
     *
     * @var  \Woisks\Comment\Models\Repository\CommentRepository
     */
    private $commentRepo;
    /**
     * typeRpo.  2019/7/20 13:58.
     *
     * @var  \Woisks\Comment\Models\Repository\TypeRepository
     */
    private $typeRpo;

    /**
     * CreateServices constructor. 2019/7/20 13:58.
     *
     * @param \Woisks\Comment\Models\Repository\CommentRepository $commentRepo
     * @param \Woisks\Comment\Models\Repository\TypeRepository    $typeRpo
     *
     * @return void
     */
    public function __construct(CommentRepository $commentRepo,
                                TypeRepository $typeRpo)
    {
        $this->commentRepo = $commentRepo;
        $this->typeRpo = $typeRpo;
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
        $content = $request->input('content');
        $parent = $request->input('parent');

        $count_db = $this->typeRpo->first($type);
        if (!$count_db) {
            return res(422, 'param type error or not exists');
        }

        $parent_db = $this->commentRepo->first($parent);
        if (!$parent_db) {
            return res(422, 'parent id  not exists');
        }
        try {
            DB::beginTransaction();

            $count_db->increment('count');
            $parent_db->increment('count');
            $comment_db = $this->commentRepo->reply($type, $content, $parent, JwtService::jwt_account_uid());
        } catch (Throwable $e) {
            DB::rollBack();

            return res(422, 'param error');
        }

        DB::commit();

        return res(200, 'success', $comment_db);
    }
}