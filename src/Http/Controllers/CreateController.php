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
     * CreateController constructor. 2019/7/28 10:18.
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
     * create. 2019/7/28 10:18.
     *
     * @param CreateRequest $request
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function create(CreateRequest $request)
    {
        $type    = $request->input('type');
        $numeric = $request->input('numeric');
        $content = $request->input('content');

        $type_db = $this->typeRpo->first($type);

        if (!$type_db) {
            return res(404, 'param type error or not exists');
        }

        try {
            DB::beginTransaction();

            $type_db->increment('count');
            $comment_db = $this->commentRepo->created($type, $numeric, $content, JwtService::jwt_account_uid());
        } catch (Throwable $e) {
            DB::rollBack();
            return res(422, 'param error');
        }

        DB::commit();

        return res(200, 'success', $comment_db);
    }

}
