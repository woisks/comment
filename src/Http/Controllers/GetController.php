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


use Woisks\Comment\Models\Repository\CommentRepository;

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
     * commentRepo.  2019/7/20 14:13.
     *
     * @var  \Woisks\Comment\Models\Repository\CommentRepository
     */
    private $commentRepo;


    /**
     * ReplyServices constructor. 2019/7/20 14:13.
     *
     * @param \Woisks\Comment\Models\Repository\CommentRepository $commentRepo
     *
     * @return void
     */
    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    /**
     * comment. 2019/7/20 14:51.
     *
     * @param $type
     * @param $numeric
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment($type, $numeric)
    {
        $comment_db = $this->commentRepo->whereGet($type, $numeric);

        if ($comment_db->isEmpty()) {
            return res(404, 'param error or not exists');
        }

        return res(200, 'success', $comment_db);
    }

    /**
     * reply. 2019/7/24 14:59.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reply($id)
    {
        $parent_db = $this->commentRepo->parent($id);

        if ($parent_db->isEmpty()) {
            return res(404, 'param error or not exists');
        }

        return res(200, 'success', $parent_db);
    }
}