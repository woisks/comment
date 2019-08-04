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
use Illuminate\Http\JsonResponse;
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
     * commentRepo.  2019/7/28 10:28.
     *
     * @var  CommentRepository
     */
    private $commentRepo;

    /**
     * typeRpo.  2019/7/28 10:28.
     *
     * @var  TypeRepository
     */
    private $typeRpo;


    /**
     * ReplyController constructor. 2019/8/4 22:18.
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
     * reply. 2019/7/28 10:28.
     *
     * @param ReplyRequest $request
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function reply(ReplyRequest $request)
    {
        $type    = $request->input('type');
        $numeric = $request->input('numeric');
        $content = $request->input('content');
        $parent  = $request->input('parent');

        $count_db = $this->typeRpo->first($type);
        //效验模块
        if (!$count_db) {
            return res(404, 'param type not exists');
        }

        $parent_db = $this->commentRepo->first($parent);
        //效验评价ID是否存在
        if (!$parent_db) {
            return res(404, 'parent id  not exists');
        }
        if ($parent_db->type != $type) {
            //效验回复当前type
            return res(422, 'param type error ');
        }

        if ($parent_db->numeric != $numeric) {
            //效验当前回复numeric
            return res(422, 'param numeric error ');
        }

        try {
            DB::beginTransaction();

            $count_db->increment('count');
            $parent_db->increment('count');

            //创建评价回复
            $comment_db = $this->commentRepo->reply($type, $numeric, $content, $parent, JwtService::jwt_account_uid());

        } catch (Throwable $e) {

            DB::rollBack();
            return res(422, 'param error');
        }

        DB::commit();
        return res(200, 'success', $comment_db);
    }
}
