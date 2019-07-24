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

namespace Woisks\Comment\Models\Services;


use Woisks\Comment\Models\Repository\CommentRepository;
use Woisks\Comment\Models\Repository\CountRepository;

/**
 * Class ReplyServices.
 *
 * @package Woisks\Comment\Models\Services
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 14:13
 */
class ReplyServices
{
    /**
     * commentRepo.  2019/7/20 14:13.
     *
     * @var  \Woisks\Comment\Models\Repository\CommentRepository
     */
    private $commentRepo;
    /**
     * countRpo.  2019/7/20 14:13.
     *
     * @var  \Woisks\Comment\Models\Repository\CountRepository
     */
    private $countRpo;

    /**
     * ReplyServices constructor. 2019/7/20 14:13.
     *
     * @param \Woisks\Comment\Models\Repository\CommentRepository $commentRepo
     * @param \Woisks\Comment\Models\Repository\CountRepository   $countRpo
     *
     * @return void
     */
    public function __construct(CommentRepository $commentRepo,
                                CountRepository $countRpo)
    {
        $this->commentRepo = $commentRepo;
        $this->countRpo = $countRpo;
    }

    /**
     * count. 2019/7/20 13:58.
     *
     * @param $type
     *
     * @return mixed
     */
    public function count($type)
    {
        return $this->countRpo->first($type);
    }


    /**
     * comment. 2019/7/20 14:13.
     *
     * @param $type
     * @param $numeric
     * @param $content
     * @param $parent_id
     * @param $uid
     *
     * @return mixed
     */
    public function comment($type, $numeric, $content, $parent_id, $uid)
    {
        return $this->commentRepo->reply($type, $numeric, $content, $parent_id, $uid);
    }

    /**
     * commentExists. 2019/7/24 13:52.
     *
     * @param $id
     *
     * @return mixed
     */
    public function first($id)
    {
        return $this->commentRepo->first($id);
    }
}