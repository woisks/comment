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
use Woisks\Comment\Models\Repository\CommentRepository;
use Woisks\Comment\Models\Repository\TypeRepository;
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

        $count_db = $this->typeRpo->first($type);

        if (!$count_db) {
            return res(422, 'param type error or not exists');
        }
        try {
            DB::beginTransaction();

            $count_db->increment('count');
            $comment_db = $this->commentRepo->created($type, $numeric, $content, JwtService::jwt_account_uid());
        } catch (Throwable $e) {
            DB::rollBack();

            return res(422, 'param error');
        }

        DB::commit();

        return res(200, 'success', $comment_db);
    }

}