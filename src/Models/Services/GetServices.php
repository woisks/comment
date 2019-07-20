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

class GetServices
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

    public function get($type, $numeric)
    {
        return $this->commentRepo->whereGet($type, $numeric);
    }
}